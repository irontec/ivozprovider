<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Psr\Log\LoggerInterface;

class CreateByScheduler
{
    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
    }

    /**
     * @throws \DomainException
     */
    public function execute(InvoiceSchedulerInterface $scheduler)
    {
        try {
            $invoice = $this->createInvoice($scheduler);
            $this->setFixedCosts($scheduler, $invoice);
            $this->updateLastExecutionDate($scheduler);
        } catch (\Exception $e) {

            $name = $scheduler->getName();
            $this->logger->error(
                "Invoice scheduler #${$name} has failed: "
                . $e->getMessage()
            );

            throw $e;
        }
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @return InvoiceInterface
     */
    private function createInvoice(InvoiceSchedulerInterface $scheduler)
    {
        $brand = $scheduler->getBrand();

        $outDate = clone $scheduler->getNextExecution();
        $outDate->setTimezone(
            new \DateTimeZone(
                $brand->getDefaultTimezone()->getTz()
            )
        );
        $outDate->setTime(0, 0, 0);
        $outDate->modify('1 second ago');

        $inDate = clone $outDate;
            $inDate->sub(
                $scheduler->getInterval()
            )->modify('+1 second');

        // Back to UTC
        $outDate->setTimezone(new \DateTimeZone('UTC'));
        $inDate->setTimezone(new \DateTimeZone('UTC'));

        $company = $scheduler->getCompany();
        $invoiceDto = new InvoiceDto();
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
                $scheduler->getNumberSequence()->getId()
            )
            ->setInvoiceTemplateId(
                $scheduler->getInvoiceTemplate()->getId()
            )
            ->setSchedulerId(
                $scheduler->getId()
            );

        return $this->entityTools->persistDto(
            $invoiceDto,
            null,
            true
        );
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @param $invoice
     */
    private function setFixedCosts(InvoiceSchedulerInterface $scheduler, $invoice)
    {
        /** @var FixedCostsRelInvoiceSchedulerInterface $relFixedCosts */
        $relFixedCosts = $scheduler->getRelFixedCosts();
        foreach ($relFixedCosts as $relFixedCost) {
            $fixedCostRelInvoice = FixedCostsRelInvoice::fromFixedCostsRelInvoiceScheduler(
                $invoice,
                $relFixedCost
            );
            $this->entityTools->persist($fixedCostRelInvoice);
        }
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @return void
     */
    private function updateLastExecutionDate(InvoiceSchedulerInterface $scheduler)
    {
        $invoiceSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $invoiceSchedulerDto->setLastExecution(
            new \DateTime()
        );

        $this->entityTools->persistDto(
            $invoiceSchedulerDto,
            $scheduler,
            true
        );
    }
}