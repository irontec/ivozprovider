<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Service\FixedCostsRelInvoice\CreateByScheduler as FixedCostsRelInvoiceByScheduler;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\SetExecutionError;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\UpdateLastExecutionDate;
use Psr\Log\LoggerInterface;

class CreateByScheduler
{
    private $entityTools;
    protected $logger;
    protected $fixedCostsRelInvoiceByScheduler;
    protected $updateLastExecutionDate;
    protected $setExecutionError;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger,
        FixedCostsRelInvoiceByScheduler $fixedCostsRelInvoiceByScheduler,
        UpdateLastExecutionDate $updateLastExecutionDate,
        SetExecutionError $setExecutionError
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->fixedCostsRelInvoiceByScheduler = $fixedCostsRelInvoiceByScheduler;
        $this->updateLastExecutionDate = $updateLastExecutionDate;
        $this->setExecutionError = $setExecutionError;
    }

    /**
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(InvoiceSchedulerInterface $scheduler)
    {
        try {
            $invoice = $this->createInvoice($scheduler);
            $this->fixedCostsRelInvoiceByScheduler->execute(
                $scheduler,
                $invoice
            );
            $this->setExecutionError->execute(
                $scheduler,
                null
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $name = $scheduler->getName();
            $this->logger->error(
                "Invoice scheduler #${name} has failed: " . $error
            );
            $this->setExecutionError->execute(
                $scheduler,
                $error
            );

            throw $e;
        } finally {
            $this->updateLastExecutionDate->execute($scheduler);
        }
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @return InvoiceInterface
     */
    private function createInvoice(InvoiceSchedulerInterface $scheduler)
    {
        $brand = $scheduler->getBrand();
        $outDate = $scheduler->getNextExecution();
        $outDate->setTimezone(
            new \DateTimeZone(
                $brand->getDefaultTimezone()->getTz()
            )
        );
        $outDate->setTime(0, 0, 0);
        $outDate->modify('1 second ago');

        $inDate = DateTimeHelper::sub(
            $outDate,
            $scheduler->getInterval()
        );
        $inDate->modify('+1 second');

        // Back to UTC
        $outDate->setTimezone(new \DateTimeZone('UTC'));
        $inDate->setTimezone(new \DateTimeZone('UTC'));

        $company = $scheduler->getCompany();
        $invoiceDto = new InvoiceDto();
        $numberSequenceId = $scheduler->getNumberSequence()
            ? $scheduler->getNumberSequence()->getId()
            : null;

        $invoiceTemplateId = $scheduler->getInvoiceTemplate()
            ? $scheduler->getInvoiceTemplate()->getId()
            : null;

        $invoiceDto
            ->setStatus(Invoice::STATUS_WAITING)
            ->setInDate($inDate)
            ->setOutDate($outDate)
            ->setTaxRate(
                $scheduler->getTaxRate()
            )
            ->setCompanyId(
                $company->getId()
            )
            ->setBrandId(
                $brand->getId()
            )
            ->setNumberSequenceId(
                $numberSequenceId
            )
            ->setInvoiceTemplateId(
                $invoiceTemplateId
            )
            ->setSchedulerId(
                $scheduler->getId()
            );

        /** @var InvoiceInterface $invoice */
        $invoice = $this->entityTools->persistDto(
            $invoiceDto,
            null,
            true
        );

        return $invoice;
    }
}
