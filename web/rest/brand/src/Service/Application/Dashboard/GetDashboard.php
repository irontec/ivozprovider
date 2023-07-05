<?php

namespace Service\Application\Dashboard;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardBrand;
use Model\Dashboard\DashboardClient;

class GetDashboard
{
    public function __construct(
        private CompanyRepository $clientRepository,
        private DdiRepository $ddiRepository,
        private CarrierRepository $carrierRepository,
    ) {
    }

    public function execute(AdministratorInterface $admin): Dashboard
    {
        $brand = $admin->getBrand();
        if (!$brand) {
            throw new \RuntimeException(
                'Empty brand found',
                403
            );
        }
        $dashboardBrand = DashboardBrand::fromBrand(
            $brand
        );

        $brandId = (int) $brand->getId();
        $dashboardClients = [];
        $latestClients = $this->clientRepository->getLatestByBrandId(
            $brandId,
            5
        );
        foreach ($latestClients as $latestClient) {
            $dashboardClients[] = DashboardClient::fromCompany($latestClient);
        }

        $clientNum = $this->clientRepository->countByBrand(
            $brandId
        );
        $ddiNum = $this->ddiRepository->countByBrand(
            $brandId
        );
        $carrierNum = $this->carrierRepository->countByBrand(
            $brandId
        );

        return new Dashboard(
            $dashboardBrand,
            $dashboardClients,
            $clientNum,
            $ddiNum,
            $carrierNum
        );
    }
}
