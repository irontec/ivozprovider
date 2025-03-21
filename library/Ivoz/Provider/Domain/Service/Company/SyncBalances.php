<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Psr\Log\LoggerInterface;

class SyncBalances
{
    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CompanyBalanceServiceInterface
     */
    private $client;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger,
        CompanyBalanceServiceInterface $client,
        CompanyRepository $companyRepository
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return void
     */
    public function updateAll()
    {
        $this->logger->info('Companies balances are about to be synced');

        $targetCompanies = $this->getPrepaidCompanyIdsGroupByBrand();
        foreach ($targetCompanies as $brandId => $companies) {
            $this->updateCompanies($brandId, $companies);
        }
    }

    /**
     * @param int $brandId
     * @param array $companyIds
     * @return bool
     */
    public function updateCompanies($brandId, array $companyIds)
    {
        try {
            $response = $this->client->getBalances($brandId, $companyIds);

            if (isset($response->error) && $response->error) {
                $this->logger->error(
                    'There was an error while retrieving brand#' . $brandId . ' company balances'
                );
                throw new \Exception($response->error);
            }

            $this->persistBalances($response->result);

            return true;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            return false;
        }
    }

    /**
     * @return array
     */
    private function getPrepaidCompanyIdsGroupByBrand()
    {
        $companies = $this->companyRepository->getPrepaidCompanies();
        $response = [];

        foreach ($companies as $company) {
            $brandId = (int) $company->getBrand()->getId();
            if (!array_key_exists($brandId, $response)) {
                $response[$brandId] = [];
            }
            $response[$brandId][] = $company->getId();
        }

        return $response;
    }

    /**
     * @return void
     */
    private function persistBalances(array $companiesBalance)
    {
        foreach ($companiesBalance as $companyId => $balance) {
            if (is_null($balance)) {
                continue;
            }

            $company = $this->companyRepository->find($companyId);
            if (!$company) {
                $this->logger->error(
                    'Company#' . $companyId . ' not found'
                );
                continue;
            }

            /** @var CompanyDto $companyDto */
            $companyDto = $this->entityTools->entityToDto($company);
            $companyDto->setBalance($balance);

            $this->entityTools->persistDto($companyDto, $company);
        }
    }
}
