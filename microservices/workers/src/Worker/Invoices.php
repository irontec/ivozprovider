<?php

namespace Worker;

use GearmanJob;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Service\Invoice\Generator;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Psr\Log\LoggerInterface;

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
     * @var EntityTools
     */
    protected $entityTools;

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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Invoices constructor.
     * @param EntityTools $entityTools
     * @param InvoiceRepository $invoiceRepository
     * @param TrunksCdrRepository $trunksCdrRepository
     * @param Generator $generator
     * @param Logger $logger
     */
    public function __construct(
        EntityTools $entityTools,
        InvoiceRepository $invoiceRepository,
        TrunksCdrRepository $trunksCdrRepository,
        Generator $generator,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->invoiceRepository = $invoiceRepository;
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->generator = $generator;
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
        $invoice->setStatus("processing");
        $this->entityTools->persist($invoice, true);

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
            $invoiceDto = $this->entityTools->entityToDto($invoice);
            $invoiceDto
                ->setPdfPath($tempPdf)
                ->setPdfBaseName('invoice-' . $invoice->getNumber() . '.pdf')
                ->setPdfMimeType('application/pdf; charset=binary')
                ->setTotal($totals["totalPrice"])
                ->setTotalWithTax($totals["totalWithTaxes"])
                ->setStatus("created");

            $this->entityTools->persistDto($invoiceDto, $invoice);
            $this->logger->info("[INVOICER] Status = created");

        } catch (\Exception $e) {
            $this->logger->info("[INVOICER] Status = error");
            $this->logger->info("[INVOICER] Error was: ".$e->getMessage());

            $invoice->setStatus("error");
            $invoice->setStatusMsg(
                $e->getMessage()
            );
            $this->entityTools->persist($invoice, true);
        }

        return true;
    }

}
