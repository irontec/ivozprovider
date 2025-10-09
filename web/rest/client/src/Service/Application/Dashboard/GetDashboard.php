<?php

namespace Service\Application\Dashboard;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Model\Dashboard\Dashboard;
use Service\Domain\Dashboard\GetResidentialInfo;
use Service\Domain\Dashboard\GetRetailInfo;
use Service\Domain\Dashboard\GetVpbxInfo;
use Service\Domain\Dashboard\GetWholeSaleInfo;
use Ivoz\Provider\Application\Service\WebPortal\ProductNameResolver;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;

class GetDashboard
{
    public function __construct(
        private GetWholeSaleInfo $getWholeSaleInfo,
        private GetVpbxInfo $getVpbxInfo,
        private GetResidentialInfo $getResidentialInfo,
        private GetRetailInfo $getRetailInfo,
        private ProductNameResolver $productNameResolver
    ) {
    }

    public function execute(AdministratorInterface $admin, string $hostName): Dashboard
    {
        $company = $admin->getCompany();

        if (is_null($company)) {
            throw new \DomainException('Company cannot be null');
        }

        $isWholeSale = $company->getType() === CompanyInterface::TYPE_WHOLESALE;
        $isRetail = $company->getType() === CompanyInterface::TYPE_RETAIL;
        $isResidential = $company->getType() === CompanyInterface::TYPE_RESIDENTIAL;
        $isVpbx = $company->getType() === CompanyInterface::TYPE_VPBX;

        $productName = $this->productNameResolver->execute(
            $hostName,
            WebPortalInterface::URLTYPE_ADMIN
        );

        if ($isWholeSale) {
            return $this->getWholeSaleInfo->execute($company, $productName);
        }

        if ($isResidential) {
            return $this->getResidentialInfo->execute($company, $productName);
        }

        if ($isRetail) {
            return $this->getRetailInfo->execute($company, $productName);
        }

        if ($isVpbx) {
            return $this->getVpbxInfo->execute($company, $productName);
        }

        throw new \DomainException(
            sprintf(
                'Unknown client type %s',
                $company->getType()
            )
        );
    }
}
