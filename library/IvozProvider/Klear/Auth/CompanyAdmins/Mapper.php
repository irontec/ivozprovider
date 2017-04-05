<?php
namespace IvozProvider\Klear\Auth\CompanyAdmins;

use IvozProvider\Mapper\Sql\CompanyAdmins;

class Mapper extends \IvozProvider\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new CompanyAdmins();
    }

    public function findByLogin($login)
    {
        $companyAdmins = $this->_mapper->fetchList(array('username=? and active=1',array($login)));

        foreach ($companyAdmins as $companyAdmin) {
            if ($companyAdmin->getCompany()->getBrandId() === $this->_brand->getId()) {
                $user = new \IvozProvider\Klear\Auth\User();
                $this->_poblateUser($user, $companyAdmin);
                $this->_populateCustomPerms($user, $companyAdmin);
                $this->_enableFeatures($user, $companyAdmin->getCompany());
                $this->_enableFeatures($user, $companyAdmin->getCompany()->getBrand());
                return $user;
            }
        }

        return null;
    }

    protected function _populateCustomPerms(\IvozProvider\Klear\Auth\User $user, $operator)
    {
        $user->isCompanyAdmin  = true;
        $user->canSeeMain = false;
        $user->canSeeBrand = false;
        $user->canSeeCompany = true;

        $user->setCompany($operator->getCompany());

        return $user;
    }

}
