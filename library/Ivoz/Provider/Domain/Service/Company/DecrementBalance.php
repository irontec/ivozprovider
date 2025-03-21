<?php

namespace Ivoz\Provider\Domain\Service\Company;

class DecrementBalance extends AbstractBalanceOperation
{
    /**
     * @param int $companyId
     * @param float $amount
     * @return boolean
     */
    public function execute($companyId, float $amount): bool
    {
        $this->logger->info('Company#%s\'s balance will be decreased by ' . $amount);
        $company = $this->companyRepository->find($companyId);
        if (!$company) {
            throw new \DomainException('Company not found');
        }
        $response = $this->companyBalanceService->decrementBalance($company, $amount);

        return $this->handleResponse(
            ($amount * -1),
            $response,
            $company
        );
    }
}
