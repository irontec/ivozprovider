<?php

namespace IvozProvider\Klear\Auth;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class User extends \Klear_Model_UserAdvanced
{
    public $isMainOperator = false;
    public $isBrandOperator = false;
    public $isCompanyAdmin = false;

    public $canSeeMain = false;
    public $canSeeBrand = false;
    public $canSeeCompany = false;

    public $brand;
    public $brandId;
    public $company;
    public $companyId;

    public $brandSetted = false;
    public $brandName;
    public $companyName;

    public $companyCountryId;
    public $brandFeatures = [];
    public $companyFeatures = [];

    public $token;
    public $refreshToken;

    public $companyType;
    public $companyVPBX = true;
    public $companyNotVPBX = false;
    public $companyResidential = false;
    public $companyNotResidential = true;
    public $companyWholesale = false;
    public $companyNotWholesale = true;
    public $companyRetail = false;
    public $companyNotRetail = true;
    public $companyShowBilling = false;
    public $companyHideBilling = true;
    public $companyRecordingRemoval = true;

    public $acls = [];

    public function setToken(string $token, string $refreshToken)
    {
        $this->token = $token;
        $this->refreshToken = $refreshToken;
    }

    public function isTokenExpired()
    {
        $decodedToken = base64_decode($this->token);
        $success = preg_match(
            '/"exp"\:([0-9]+),/',
            $decodedToken,
            $matches
        );

        if (!$success) {
            return true;
        }

        $now = time();
        $expires = (int) $matches[1] ?? 0;

        return $expires <= $now;
    }

    public function setUserName($username)
    {
        $this->_name = $username;
        return $this;
    }

    public function setBrand(BrandDto $brand)
    {
        $this->brand = $brand;
        $this->brandId = $brand->getId();
        $this->brandName = $brand->getName();
        $this->brandSetted = true;
    }

    public function getBrand()
    {
        return $this->brand;
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


    public function setCompany(CompanyDto $company)
    {
        $this->company = $company;
        $this->companyId = $company->getId();
        $this->companyCountryId = $company->getCountryId();
        $this->companyName = $company->getName();
        $this->companyType = $company->getType();
        $this->companyVPBX = $company->getType() === CompanyInterface::TYPE_VPBX;
        $this->companyNotVPBX = $company->getType() != CompanyInterface::TYPE_VPBX;
        $this->companyResidential = $company->getType() === CompanyInterface::TYPE_RESIDENTIAL;
        $this->companyNotResidential = $company->getType() != CompanyInterface::TYPE_RESIDENTIAL;
        $this->companyWholesale = $company->getType() === CompanyInterface::TYPE_WHOLESALE;
        $this->companyNotWholesale = $company->getType() != CompanyInterface::TYPE_WHOLESALE;
        $this->companyRetail = $company->getType() === CompanyInterface::TYPE_RETAIL;
        $this->companyNotRetail = $company->getType() != CompanyInterface::TYPE_RETAIL;
        $this->companyShowBilling = $company->getShowInvoices() == 1;
        $this->companyHideBilling = $company->getShowInvoices() == 0;
        $this->companyRecordingRemoval = $company->getAllowRecordingRemoval() !== false;
    }

    public function getCompany()
    {
        return $this->company;
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

    public function setBrandFeatures($features)
    {
        $this->brandFeatures = $features;
    }

    public function setCompanyFeatures($features)
    {
        $this->companyFeatures = $features;
    }

    public function getUniqueIdenForCache()
    {
        // Devuelve un hash basado en las propiedades publicas
        return md5(print_r(call_user_func('get_object_vars', $this), true));
    }

    public function __toString()
    {
        return 'Administrator#' . $this->getId();
    }
}
