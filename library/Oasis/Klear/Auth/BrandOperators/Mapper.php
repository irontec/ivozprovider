<?php
namespace Oasis\Klear\Auth\BrandOperators;

use Oasis\Mapper\Sql\BrandOperators;

class Mapper extends \Oasis\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new BrandOperators();
    }

    protected function _populateCustomPerms(\Oasis\Klear\Auth\User $user, $operator)
    {
        $user->isBrandOperator = true;
        
        $user->canSeeMain = false;
        $user->canSeeBrand = true;
        $user->canSeeCompany = true;

        $user->setBrand($operator->getBrand());
        
        return $user;
    }
}