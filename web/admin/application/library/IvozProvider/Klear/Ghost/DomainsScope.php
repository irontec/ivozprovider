<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;

class IvozProvider_Klear_Ghost_DomainsScope extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param DomainDto $model
     * @return string name of target based on domain scope
     * @throws Zend_Exception
     */
    public function getData($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var CompanyDto $company */
        $company = $dataGateway->findOneBy(Company::class, [
            "Company.domain = " . $model->getId()
        ]);

        if ($company) {
            return $company->getName() . ' (company)';
        }

        /** @var BrandDto $brand */
        $brand = $dataGateway->findOneBy(Brand::class, [
            "Brand.domain = " . $model->getId()
        ]);

        if ($brand) {
            return $brand->getName() . ' (brand)';
        }

        return "Global";
    }
}
