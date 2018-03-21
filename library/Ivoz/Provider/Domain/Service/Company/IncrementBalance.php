<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;
use Symfony\Bridge\Monolog\Logger;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

class IncrementBalance
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
     * @var CompanyBalanceServiceClientInterface
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

    public function __construct(
        DoctrineEntityPersister $entityPersister,
        Logger $logger,
        CompanyBalanceServiceClientInterface $client,
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
    public function execute($companyId, float $amount)
    {
        $this->logger->info('Company#%s\'s balance will be incremented by ' . $amount);
        $company = $this->companyRepository->find($companyId);
        $response = $this->client->incrementBalance($company, $amount);

        if ($response['error']) {
            $this->lastError = $response['error'];
            $this->logger->error('Could not increment balance: ' . $response['error']);
        }
        $success = $response['success'];

        if ($success) {
            $brandId = $company->getBrand()->getId();
            $companyIds = [$company->getId()];

            $this->syncBalanceService->updateCompanies($brandId, $companyIds);
        }

        return $success;
    }

    public function getLastError()
    {
        return $this->lastError;
    }
}