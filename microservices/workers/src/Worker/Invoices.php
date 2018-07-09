<?php

namespace Worker;

use GearmanJob;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Service\Invoice\Generator;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Monolog\Logger;

/**
 * @Gearman\Work(
 *     name = "Invoices",
 *     description = "Handle Invoices files related async tasks",
 *     service = "Worker\Invoices",
 *     iterations = 1
 * )
 */
class Invoices
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @var DtoAssembler
     */
    protected $dtoAssembler;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Invoices constructor.
     * @param EntityPersisterInterface $entityPersister
     * @param InvoiceRepository $invoiceRepository
     * @param Logger $logger
     */
    public function __construct(
        EntityPersisterInterface $entityPersister,
        InvoiceRepository $invoiceRepository,
        TrunksCdrRepository $trunksCdrRepository,
        Generator $generator,
        DtoAssembler $dtoAssembler,
        Logger $logger
    ) {
        $this->entityPersister = $entityPersister;
        $this->invoiceRepository = $invoiceRepository;
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->generator = $generator;
        $this->dtoAssembler = $dtoAssembler;
        $this->logger = $logger;
    }

    /**
     * @Gearman\Job(
     *     name = "create",
     *     description = "Create new invoice"
     * )
     *
     * @param GearmanJob $serializedJob Serialized object with job parameters
     * @return bool
     */
    public function create(GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $job = igbinary_unserialize($serializedJob->workload());

        $id = $job->getId();
        $this->logger->info("[INVOICER] ID = " . $id);

        $this->trunksCdrRepository->resetInvoiceId($id);

        /** @var InvoiceInterface $invoice */
        $invoice = $this->invoiceRepository->find($id);
        if (!$invoice) {
            $this->logger->error("Invoice #${id} was not found!");
            return;
        }

        $invoice->setStatus("processing");
        $this->entityPersister->persist($invoice, true);

        $this->logger->info("[INVOICER] Status = processing");

        try {

            $content = $this->generator->getInvoicePDFContents($id);
            $tempPath = "/opt/irontec/ivozprovider/storage/invoice";
            if (!file_exists($tempPath)) {
                mkdir($tempPath);
            }
            $tempPdf = $tempPath."/temp". $invoice->getId() .".pdf";
            file_put_contents($tempPdf, $content);

            $totals = $this->generator->getTotals();
            /** @var InvoiceDto $invoiceDto */
            $invoiceDto = $this->dtoAssembler->toDto($invoice);
            $invoiceDto
                ->setPdfPath($tempPdf)
                ->setPdfBaseName('invoice-' . $invoice->getNumber() . '.pdf')
                ->setPdfMimeType('application/pdf; charset=binary')
                ->setTotal($totals["totalPrice"])
                ->setTotalWithTax($totals["totalWithTaxes"])
                ->setStatus("created");

            $this->entityPersister->persistDto($invoiceDto, $invoice);
            $this->logger->info("[INVOICER] Status = created");

        } catch (\Exception $e) {
            $this->logger->info("[INVOICER] Status = error");
            $this->logger->info("[INVOICER] Error was: ".$e->getMessage());

            $invoice->setStatus("error");
            $invoice->setStatusMsg(
                $e->getMessage()
            );
            $this->entityPersister->persist($invoice, true);
        }

        return true;
    }

}
