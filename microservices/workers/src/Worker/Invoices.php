<?php

namespace Worker;

use GearmanJob;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Service\Invoice\Generator;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Psr\Log\LoggerInterface;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

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
    use RegisterCommandTrait;

    private $eventPublisher;
    private $requestId;
    private $entityTools;
    private $invoiceRepository;
    private $billableCallRepository;
    private $generator;
    private $logger;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        EntityTools $entityTools,
        InvoiceRepository $invoiceRepository,
        BillableCallRepository $billableCallRepository,
        Generator $generator,
        LoggerInterface $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->entityTools = $entityTools;
        $this->invoiceRepository = $invoiceRepository;
        $this->billableCallRepository = $billableCallRepository;
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
     * @return bool | null
     */
    public function create(GearmanJob $serializedJob)
    {
        try {
            // Thanks Gearmand, you've done your job
            $serializedJob->sendComplete("DONE");

            $job = igbinary_unserialize($serializedJob->workload());
            $id = $job->getId();

            $this->registerCommand('Worker', 'invoices', ['id' => $id]);

            $this->logger->info("[INVOICER] ID = " . $id);

            $this->billableCallRepository->resetInvoiceId($id);

            /** @var InvoiceInterface | null $invoice */
            $invoice = $this->invoiceRepository->find($id);
            if (!$invoice) {
                $this->logger->error("Invoice #${id} was not found!");
                return null;
            }

            /** @var InvoiceDto $invoiceDto */
            $invoiceDto = $this->entityTools->entityToDto($invoice);

            $invoiceDto->setStatus(InvoiceInterface::STATUS_PROCESSING);
            $this->entityTools->persistDto($invoiceDto, $invoice, true);

            $this->logger->info("[INVOICER] Status = processing");

            $content = $this->generator->getInvoicePDFContents($id);
            $tempPath = "/opt/irontec/ivozprovider/storage/invoice";
            if (!file_exists($tempPath)) {
                mkdir($tempPath);
            }
            $tempPdf = $tempPath."/temp". $invoice->getId() .".pdf";
            file_put_contents($tempPdf, $content);

            $totals = $this->generator->getTotals();
            /** @var InvoiceDto $invoiceDto */
            $invoiceDto
                ->setPdfPath($tempPdf)
                ->setPdfBaseName('invoice-' . $invoice->getNumber() . '.pdf')
                ->setPdfMimeType('application/pdf; charset=binary')
                ->setTotal($totals["totalPrice"])
                ->setTotalWithTax($totals["totalWithTaxes"])
                ->setStatus(InvoiceInterface::STATUS_CREATED);

            $this->entityTools->persistDto($invoiceDto, $invoice);
            $this->logger->info("[INVOICER] Status = created");
        } catch (\Exception $e) {
            $this->logger->info("[INVOICER] Status = error");
            $this->logger->error("[INVOICER] Error was: " . $e->getMessage());

            if (!isset($invoiceDto)) {
                exit(1);
            }

            if (!isset($invoice)) {
                exit(1);
            }

            $invoiceDto->setStatus(InvoiceInterface::STATUS_ERROR);
            $invoiceDto->setStatusMsg(
                $e->getMessage()
            );

            $this->entityTools->persistDto(
                $invoiceDto,
                $invoice,
                true
            );
        }

        return true;
    }
}
