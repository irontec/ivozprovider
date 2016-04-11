<?php
namespace Oasis\Klear\Auth\CompanyAdmins;

use Oasis\Mapper\Sql\CompanyAdmins;

class Mapper extends \Oasis\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new CompanyAdmins();
    }

    protected function _populateCustomPerms(\Oasis\Klear\Auth\User $user, $operator)
    {
        $user->isCompanyAdmin  = true;
        $user->canSeeMain = false;
        $user->canSeeBrand = false;
        $user->canSeeCompany = true;
        
        $user->setCompany($operator->getCompany());
        
        return $user;
    }
}