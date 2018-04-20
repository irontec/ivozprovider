<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Symfony\Bridge\Monolog\Logger;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

abstract class AbstractBalanceOperation
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var CompanyBalanceServiceInterface
     */
    protected $client;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var SyncBalances
     */
    protected $syncBalanceService;

    /**
     * @var string
     */
    protected $lastError;

    /**
     * IncrementBalance constructor.
     *
     * @param DoctrineEntityPersister $entityPersister
     * @param Logger $logger
     * @param CompanyBalanceServiceInterface $client
     * @param CompanyRepository $companyRepository
     * @param SyncBalances $syncBalanceService
     */
    public function __construct(
        DoctrineEntityPersister $entityPersister,
        Logger $logger,
        CompanyBalanceServiceInterface $client,
        CompanyRepository $companyRepository,
        SyncBalances $syncBalanceService
    ) {
        $this->entityPersister = $entityPersister;
        $this->logger = $logger;
        $this->client = $client;
        $this->companyRepository = $companyRepository;
        $this->syncBalanceService = $syncBalanceService;
    }

    /**
     * @param $companyId
     * @param float $amount
     * @return boolean
     */
    abstract public function execute($companyId, float $amount);

    /**
     * @param CompanyInterface $companyId
     * @param float $amount
     * @return boolean
     */
    protected function handleResponse($amount, array $response, CompanyInterface $company)
    {
        if ($response['error']) {
            $this->lastError = $response['error'];
            $this->logger->error('Could not modify balance: ' . $response['error']);
        }

        $success = $response['success'];

        if ($success) {
            $brandId = $company->getBrand()->getId();
            $companyIds = [$company->getId()];

            $this->syncBalanceService->updateCompanies($brandId, $companyIds);

            // Get current balance status
            $balance = $this->client->getBalance($brandId, $company->getId());

            // Store this transaction in a BalanceMovement
            $balanceMovementDto = BalanceMovement::createDto();
            $balanceMovementDto
                ->setCompanyId($company->getId())
                ->setAmount($amount)
                ->setBalance($balance);

            $this->entityPersister->persistDto($balanceMovementDto, null, true);
        }

        return $success;
    }

    public function getLastError()
    {
        return $this->lastError;
    }
}