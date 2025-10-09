<?php

namespace Service\Application\Dashboard;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardBrand;
use Model\Dashboard\DashboardClient;
use Ivoz\Provider\Application\Service\WebPortal\ProductNameResolver;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;

class GetDashboard
{
    public function __construct(
        private CompanyRepository $clientRepository,
        private DdiRepository $ddiRepository,
        private CarrierRepository $carrierRepository,
        private ProductNameResolver $productNameResolver,
    ) {
    }

    public function execute(AdministratorInterface $admin, string $hostname): Dashboard
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

        $productName = $this->productNameResolver->execute(
            $hostname,
            WebPortalInterface::URLTYPE_BRAND
        );

        return new Dashboard(
            $dashboardBrand,
            $dashboardClients,
            $clientNum,
            $ddiNum,
            $carrierNum,
            $productName
        );
    }
}
