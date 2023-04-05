<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Service\BalanceMovement\CreateByCompany;
use Symfony\Bridge\Monolog\Logger;

abstract class AbstractBalanceOperation
{
    private string $lastError;

    public function __construct(
        protected EntityTools $entityTools,
        protected Logger $logger,
        protected CompanyBalanceServiceInterface $companyBalanceService,
        protected CompanyRepository $companyRepository,
        protected SyncBalances $syncBalanceService,
        protected CreateByCompany $createBalanceMovementByCompany
    ) {
    }

    /**
     * @param int $companyId
     * @param float $amount
     * @return boolean
     */
    abstract public function execute($companyId, float $amount);

    protected function handleResponse(?float $amount, array $response, CompanyInterface $company): bool
    {
        $success = false;
        if (isset($response['error']) && $response['error']) {
            $this->lastError = $response['error'];
            $this->logger->error('Could not modify balance: ' . $response['error']);
        }

        if (isset($response['success']) && $response['success']) {
            $success = $response['success'];

            $brandId = (int) $company->getBrand()->getId();
            $companyIds = [(int) $company->getId()];

            $this->syncBalanceService->updateCompanies($brandId, $companyIds);

            // Get current balance status
            $balance = $this->companyBalanceService->getBalance(
                $brandId,
                (int) $company->getId()
            );

            $this->createBalanceMovementByCompany->execute(
                $company,
                $amount,
                $balance
            );
        }

        return $success;
    }

    /**
     * @return string
     */
    public function getLastError(): string
    {
        return $this->lastError;
    }
}
