<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Psr\Log\LoggerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

class SyncBalances
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
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

    public function updateAll()
    {
        $this->logger->info('Companies balances are about to be synced');

        $targetCompanies = $this->getPrepaidCompanyIdsGroupByBrand();
        foreach ($targetCompanies as $brandId => $companies) {
            $this->updateCompanies($brandId, $companies);
        }
    }

    /**
     * @param $brandId
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
            $brandId = $company->getBrand()->getId();
            if (!array_key_exists($brandId, $response)) {
                $response[$brandId] = [];
            }
            $response[$brandId][] = $company->getId();
        }

        return $response;
    }

    private function persistBalances(array $companiesBalance)
    {
        foreach ($companiesBalance as $companyId => $balance) {

            /** @var CompanyInterface $company */
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
