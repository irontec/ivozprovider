<?php

namespace IvozProvider\Klear\Auth;
use IvozProvider\Model\Brands;
use IvozProvider\Model\Companies;
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

    public function setBrand(Brands $brand)
    {
        $this->brandId = $brand->getPrimaryKey();
        $this->brandName = $brand->getName();
        $this->brandSetted = true;

    }

    public function setBrandId($brandId)
    {

        $bMapper = new \IvozProvider\Mapper\Sql\Brands();
        $brand = $bMapper->find($brandId);
        if (!$brand) {
            throw new \Exception("Invalid brand");
        }
        $this->setBrand($brand);
    }


    public function setCompany(Companies $company)
    {
        $this->companyId = $company->getPrimaryKey();
        $this->companyCountryId = $company->getCountryId();
        $this->companyName = $company->getName();
        $this->companyType = $company->getType();
        $this->companyVPBX = $company->getType() === Companies::VPBX;
        $this->companyRetail = $company->getType() === Companies::RETAIL;
    }

    public function unsetCompany()
    {
        $this->companyId = null;
        $this->companyCountryId = null;
        $this->companyName = null;
    }

    public function setCompanyId($companyId)
    {
        $cMapper = new \IvozProvider\Mapper\Sql\Companies();
        $company = $cMapper->find($companyId);
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
