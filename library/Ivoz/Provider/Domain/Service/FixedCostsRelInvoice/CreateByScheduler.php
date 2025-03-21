<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceDto;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class CreateByScheduler
{
    public function __construct(
        private EntityTools $entityTools,
        private DdiRepository $ddiRepository
    ) {
    }

    public function execute(
        InvoiceSchedulerInterface $scheduler,
        InvoiceInterface $invoice
    ): void {
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
                $companyCountry = $company->getCountry();
                // DDI Match All Countries
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_ALL) {
                    $quantity = $this->ddiRepository->countByCompany(
                        (int) $company->getId()
                    );
                }
                // DDI Match from client country
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_NATIONAL) {
                    $quantity = $this->ddiRepository->countByCompanyAndCountry(
                        (int) $company->getId(),
                        (int) $companyCountry->getId()
                    );
                }
                // DDI Match NOT from client country
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_INTERNATIONAL) {
                    $quantity = $this->ddiRepository->countByCompanyAndNotCountry(
                        (int) $company->getId(),
                        (int) $companyCountry->getId()
                    );
                }
                // DDI Match from specific country
                if ($ddisMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_SPECIFIC) {
                    $ddisCountry = $relFixedCost->getDdisCountry();
                    if (!$ddisCountry) {
                        return;
                    }
                    $quantity = $this->ddiRepository->countByCompanyAndCountry(
                        (int) $company->getId(),
                        (int) $ddisCountry->getId()
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
