<?php

namespace Ivoz\Kam\Domain\Service\UsersLocation;

use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;

class BrandRegistrationSummary
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
     * @return array|\Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationInterface[]
     */
    public function getUsersLocations(BrandInterface $brand)
    {
        $domains = $this->domainRepository->findByBrandId(
            (int) $brand->getId()
        );

        $domainFqdns = [];
        foreach ($domains as $domain) {
            $domainFqdns[] = $domain->getDomain();
        }

        $userLocations = $this->usersLocationRepository->findByDomains(
            $domainFqdns
        );

        return $userLocations;
    }

    /**
     * @param int $brandId
     * @return int
     */
    public function getDeviceNumber(int $brandId): int
    {
        $total = 0;

        $vpbxIds = $this->companyRepository->getVpbxIdsByBrand($brandId);
        $residentialIds = $this->companyRepository->getResidentialIdsByBrand($brandId);
        $retailIds = $this->companyRepository->getRetailIdsByBrand($brandId);

        $total += $this->terminalRepository->countRegistrableDevices($vpbxIds);
        $total += $this->friendRepository->countRegistrableDevices($vpbxIds);
        $total += $this->residentialDeviceRepository->countRegistrableDevicesByCompanies($residentialIds);
        $total += $this->retailAccountRepository->countRegistrableDevicesByCompanies($retailIds);

        return $total;
    }
}
