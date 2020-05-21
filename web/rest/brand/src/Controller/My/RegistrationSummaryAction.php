<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Model\RegistrationSummary;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class RegistrationSummaryAction
{
    protected $tokenStorage;
    protected $domainRepository;
    protected $usersLocationRepository;
    protected $companyRepository;
    protected $terminalRepository;
    protected $friendRepository;
    protected $residentialDeviceRepository;
    protected $retailAccountRepository;

    public function __construct(
        TokenStorage $tokenStorage,
        DomainRepository $domainRepository,
        UsersLocationRepository $usersLocationRepository,
        CompanyRepository $companyRepository,
        TerminalRepository $terminalRepository,
        FriendRepository $friendRepository,
        ResidentialDeviceRepository $residentialDeviceRepository,
        RetailAccountRepository $retailAccountRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->domainRepository = $domainRepository;
        $this->usersLocationRepository = $usersLocationRepository;
        $this->companyRepository = $companyRepository;
        $this->terminalRepository = $terminalRepository;
        $this->friendRepository = $friendRepository;
        $this->residentialDeviceRepository = $residentialDeviceRepository;
        $this->retailAccountRepository = $retailAccountRepository;
    }

    public function __invoke()
    {
        /** @var TokenInterface|null $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();
        $brand = $user->getBrand();

        if (!$brand) {
            throw new NotFoundHttpException('Brand not found');
        }

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

        $active = count($userLocations);
        $total = $this->getTotalDevices(
            $brand->getId()
        );

        return new RegistrationSummary(
            $active,
            $total
        );
    }

    /**
     * @param int $brandId
     * @return int
     */
    private function getTotalDevices(int $brandId): int
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
