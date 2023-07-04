<?php

namespace Service\Application\Dashboard;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardAdmin;
use Model\Dashboard\DashboardBrand;

class GetDashboard
{
    public function __construct(
        private BrandRepository $brandRepository,
        private CompanyRepository $clientRepository,
        private UserRepository $userRepository,
    ) {
    }

    public function execute(AdministratorInterface $admin): Dashboard
    {
        $latestBrands = $this->brandRepository->getLatest(5);
        $dashboardBrands = [];
        foreach ($latestBrands as $latestBrand) {
            $dashboardBrands[] = DashboardBrand::fromBrand($latestBrand);
        }

        $dashboardAdmin = DashboardAdmin::fromAdministrator(
            $admin
        );
        $brandNum = $this->brandRepository->count([]);
        $clientNum = $this->clientRepository->count([]);
        $userNum = $this->userRepository->count([]);

        return new Dashboard(
            $dashboardAdmin,
            $dashboardBrands,
            $brandNum,
            $clientNum,
            $userNum
        );
    }
}
