<?php
namespace IvozProvider\Klear\Auth\CompanyAdmins;

use IvozProvider\Mapper\Sql\CompanyAdmins;

class Mapper extends \IvozProvider\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new CompanyAdmins();
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