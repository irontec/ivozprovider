<?php

namespace Ivoz\Kam\Domain\Service\UsersLocation;

use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;

class CompanyRegistrationSummary
{
    public function __construct(
        private DomainRepository $domainRepository,
        private UsersLocationRepository $usersLocationRepository,
        private CompanyRepository $companyRepository,
        private TerminalRepository $terminalRepository,
        private FriendRepository $friendRepository,
        private ResidentialDeviceRepository $residentialDeviceRepository,
        private RetailAccountRepository $retailAccountRepository
    ) {
    }

    /**
     * @param CompanyInterface $company
     * @return array
     */
    public function getUsersLocations(CompanyInterface $company): array
    {
        $domain = $this->domainRepository->findByCompanyId(
            $company->getId()
        );

        if (!$domain) {
            $domain = $company
                ->getBrand()
                ->getDomain();
        }

        $domainFqdn = $domain->getDomain();
        $names = $this->getDeviceNames($company);

        return $this->usersLocationRepository->findByNamesInDomain(
            $names,
            $domainFqdn
        );
    }

    public function getDeviceNumber(CompanyInterface $company)
    {
        $ids = [$company->getId()];

        if ($company->isWholesale()) {
            return 0;
        }

        if ($company->isResidential()) {
            return $this
                ->residentialDeviceRepository
                ->countRegistrableDevicesByCompanies($ids);
        }

        if ($company->isRetail()) {
            return $this
                ->retailAccountRepository
                ->countRegistrableDevicesByCompanies($ids);
        }

        $total = 0;
        $total += $this->terminalRepository->countRegistrableDevices($ids);
        $total += $this->friendRepository->countRegistrableDevices($ids);

        return $total;
    }

    private function getDeviceNames(CompanyInterface $company):array
    {
        if ($company->isWholesale()) {
            return [];
        }
        $companyId = $company->getId();

        if ($company->isResidential()) {
            return $this
                ->residentialDeviceRepository
                ->findNamesByCompanyId(
                    $companyId
                );
        }

        if ($company->isRetail()) {
            return $this
                ->retailAccountRepository
                ->findNamesByCompanyId(
                    $companyId
                );
        }

        $terminalNames = $this->terminalRepository->findNamesByCompanyId(
            $companyId
        );

        $friendNames = $this->friendRepository->findNamesByCompanyId(
            $companyId
        );

        return array_merge(
            $terminalNames,
            $friendNames
        );
    }
}
