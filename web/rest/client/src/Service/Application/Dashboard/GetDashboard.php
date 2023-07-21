<?php

namespace Service\Application\Dashboard;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Model\Dashboard\Dashboard;
use Service\Domain\Dashboard\GetResidentialInfo;
use Service\Domain\Dashboard\GetRetailInfo;
use Service\Domain\Dashboard\GetVpbxInfo;
use Service\Domain\Dashboard\GetWholeSaleInfo;

class GetDashboard
{
    public function __construct(
        private GetWholeSaleInfo $getWholeSaleInfo,
        private GetVpbxInfo $getVpbxInfo,
        private GetResidentialInfo $getResidentialInfo,
        private GetRetailInfo $getRetailInfo
    ) {
    }

    public function execute(AdministratorInterface $admin): Dashboard
    {
        $company = $admin->getCompany();

        if (is_null($company)) {
            throw new \DomainException('Company cannot be null');
        }

        $isWholeSale = $company->getType() === CompanyInterface::TYPE_WHOLESALE;
        $isRetail = $company->getType() === CompanyInterface::TYPE_RETAIL;
        $isResidential = $company->getType() === CompanyInterface::TYPE_RESIDENTIAL;
        $isVpbx = $company->getType() === CompanyInterface::TYPE_VPBX;

        if ($isWholeSale) {
            return $this->getWholeSaleInfo->execute($company);
        }

        if ($isResidential) {
            return $this->getResidentialInfo->execute($company);
        }

        if ($isRetail) {
            return $this->getRetailInfo->execute($company);
        }

        if ($isVpbx) {
            return $this->getVpbxInfo->execute($company);
        }

        throw new \DomainException(
            sprintf(
                'Unknown client type %s',
                $company->getType()
            )
        );
    }
}
