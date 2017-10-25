<?php

namespace IvozProvider\Klear\Auth;
use \Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use \Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;


class User extends \Klear_Model_UserAdvanced
{
    public $isMainOperator = false;
    public $isBrandOperator = false;
    public $isCompanyAdmin = false;

    public $canSeeMain = false;
    public $canSeeBrand = false;
    public $canSeeCompany = false;

    public $brandId = null;
    public $companyId = null;

    public $brandSetted = false;

    public $brandName = null;
    public $companyName = null;

    public $companyCountryId = null;


    public function setUserName($username)
    {
        $this->_name = $username;
        return $this;
    }

    public function setBrand(BrandDTO $brand)
    {
        $this->brandId = $brand->getId();
        $this->brandName = $brand->getName();
        $this->brandSetted = true;
    }

    public function setBrandId($brandId)
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        $brand = $dataGateway->find(
            Brand::class,
            $brandId
        );

        if (!$brand) {
            throw new \Exception("Invalid brand");
        }
        $this->setBrand($brand);
    }


    public function setCompany(CompanyDTO $company)
    {
        $this->companyId = $company->getId();
        $this->companyCountryId = $company->getCountryId();
        $this->companyName = $company->getName();
        $this->companyType = $company->getType();
        $this->companyVPBX = $company->getType() === Company::VPBX;
        $this->companyRetail = $company->getType() === Company::RETAIL;
    }

    public function unsetCompany()
    {
        $this->companyId = null;
        $this->companyCountryId = null;
        $this->companyName = null;
    }

    public function setCompanyId($companyId)
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        $company = $dataGateway->find(
            Company::class,
            $companyId
        );

        if (!$company) {
            throw new \Exception("Invalid company");
        }
        $this->setCompany($company);
    }

    public function getUserName()
    {
        return $this->_name;
    }

    public function getUniqueIdenForCache()
    {
        // Devuelve un hash basado en las propiedades publicas
        return md5(print_r(call_user_func('get_object_vars', $this), true));
    }

}
