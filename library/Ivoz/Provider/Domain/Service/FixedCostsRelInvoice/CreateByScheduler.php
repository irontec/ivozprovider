<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceDto;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class CreateByScheduler
{
    private $entityTools;

    private $ddiRepository;

    public function __construct(
        EntityTools $entityTools,
        DdiRepository $ddiRepository
    ) {
        $this->entityTools = $entityTools;
        $this->ddiRepository = $ddiRepository;
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @param InvoiceInterface $invoice
     *
     * @return void
     */
    public function execute(
        InvoiceSchedulerInterface $scheduler,
        InvoiceInterface $invoice
    ) {
        $company = $invoice->getCompany();
        $relFixedCosts = $scheduler->getRelFixedCosts();
        foreach ($relFixedCosts as $relFixedCost) {
            // Calculate Dynamic quantities
            $quantity = $relFixedCost->getQuantity();
            $type = $relFixedCost->getType();
            if ($type === FixedCostsRelInvoiceSchedulerInterface::TYPE_MAXCALLS) {
                // Quantity based on Client Max Calls setting
                $quantity = $company->getMaxCalls();
            } elseif ($type === FixedCostsRelInvoiceSchedulerInterface::TYPE_DDIS) {
                // Quantity based on Client DDI Count
                $ddisMatch = $relFixedCost->getDdisCountryMatch();
                $ddisCountry = $relFixedCost->getDdisCountry();
                $companyCountry = $company->getCountry();
                // DDI Match All Countries
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_ALL) {
                    $quantity = $this->ddiRepository->countByCompany(
                        $company->getId()
                    );
                }
                // DDI Match from client country
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_NATIONAL) {
                    $quantity = $this->ddiRepository->countByCompanyAndCountry(
                        $company->getId(),
                        $companyCountry->getId()
                    );
                }
                // DDI Match NOT from client country
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_INTERNATIONAL) {
                    $quantity = $this->ddiRepository->countByCompanyAndNotCountry(
                        $company->getId(),
                        $companyCountry->getId()
                    );
                }
                // DDI Match from specific country
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_SPECIFIC) {
                    $quantity = $this->ddiRepository->countByCompanyAndCountry(
                        $company->getId(),
                        $ddisCountry->getId()
                    );
                }
            }

            $fixedCostRelInvoiceDto = new FixedCostsRelInvoiceDto();
            $fixedCostRelInvoiceDto
                ->setQuantity(
                    $quantity
                )
                ->setFixedCostId(
                    $relFixedCost->getFixedCost()->getId()
                )
                ->setInvoiceId(
                    $invoice->getId()
                );

            $this->entityTools->persistDto($fixedCostRelInvoiceDto);
        }
    }
}
