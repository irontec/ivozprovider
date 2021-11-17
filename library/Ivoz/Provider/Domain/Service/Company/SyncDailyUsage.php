<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Psr\Log\LoggerInterface;

class SyncDailyUsage
{
    public function __construct(
        private EntityTools $entityTools,
        private LoggerInterface $logger,
        private CompanyBalanceServiceInterface $client,
        private CompanyRepository $companyRepository
    ) {
    }

    /**
     * @return void
     */
    public function updateAll()
    {
        $this->logger->info('Companies daily usage are about to be synced');

        $companies = $this->companyRepository->findAll();
        foreach ($companies as $company) {
            try {
                $this->updateCompany($company);
            } catch (\Exception $exception) {
                $this->logger->error(
                    'There was an error while retrieving company #' . $company->getId() . ' daily usage'
                );
                $this->logger->error(
                    $exception->getMessage()
                );
            }
        }

        $this
            ->entityTools
            ->dispatchQueuedOperations();
    }

    /**
     * @return void
     */
    public function updateCompany(
        CompanyInterface $company,
        bool $persistImmediately = false
    ) {
        $amount = $this->client->getCurrentDayUsage(
            (int) $company->getBrand()->getId(),
            (int) $company->getId()
        );

        // If numeric amount, round to 4 decimals value
        if (is_numeric($amount)) {
            $amount = round($amount, 4);
        }

        /** @var CompanyDto $companyDto */
        $companyDto = $this
            ->entityTools
            ->entityToDto($company);

        $companyDto->setCurrentDayUsage($amount);

        $this->entityTools->persistDto(
            $companyDto,
            $company,
            $persistImmediately
        );
    }
}
