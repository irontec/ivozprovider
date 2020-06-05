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
    protected $domainRepository;
    protected $usersLocationRepository;
    protected $companyRepository;
    protected $terminalRepository;
    protected $friendRepository;
    protected $residentialDeviceRepository;
    protected $retailAccountRepository;

    public function __construct(
        DomainRepository $domainRepository,
        UsersLocationRepository $usersLocationRepository,
        CompanyRepository $companyRepository,
        TerminalRepository $terminalRepository,
        FriendRepository $friendRepository,
        ResidentialDeviceRepository $residentialDeviceRepository,
        RetailAccountRepository $retailAccountRepository
    ) {
        $this->domainRepository = $domainRepository;
        $this->usersLocationRepository = $usersLocationRepository;
        $this->companyRepository = $companyRepository;
        $this->terminalRepository = $terminalRepository;
        $this->friendRepository = $friendRepository;
        $this->residentialDeviceRepository = $residentialDeviceRepository;
        $this->retailAccountRepository = $retailAccountRepository;
    }

    /**
     * @return array|\Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationInterface[]
     */
    public function getUsersLocations(BrandInterface $brand)
    {
        $domains = $this->domainRepository->findByBrandId(
            $brand->getId()
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
