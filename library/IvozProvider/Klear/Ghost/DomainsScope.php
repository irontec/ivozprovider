<?php

use Doctrine\Common\Collections\Criteria;
use \Ivoz\Provider\Domain\Model\Company\Company;
use \Ivoz\Provider\Domain\Model\Brand\Brand;

class IvozProvider_Klear_Ghost_DomainsScope extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainDTO $model
     * @return name of target based on domain scope
     */
    public function getData ($model)
    {
        /** @var \ZfBundle\Services\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyDTO $company */
        $company = $dataGateway->findOneBy(Company::class, [
                "Company.domain = " . $model->getId()
        ]);

        if ($company) {
            return $company->getName() . ' (company)';
        }

        /** @var \Ivoz\Provider\Domain\Model\Brand\BrandDTO $brand */
        $brand = $dataGateway->findOneBy(Brand::class, [
            "Brand.domain = " . $model->getId()
        ]);

        if ($brand) {
            return $brand->getName() . ' (brand)';
        }

        return "Global";
    }
}
