<?php
namespace IvozProvider\Klear\Auth\BrandOperators;

use IvozProvider\Mapper\Sql\BrandOperators;

class Mapper extends \IvozProvider\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new BrandOperators();
    }

    protected function _populateCustomPerms(\IvozProvider\Klear\Auth\User $user, $operator)
    {
        $user->isBrandOperator = true;
        
        $user->canSeeMain = false;
        $user->canSeeBrand = true;
        $user->canSeeCompany = true;

        $user->setBrand($operator->getBrand());
        
        return $user;
    }
}