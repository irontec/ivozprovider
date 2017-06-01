<?php
namespace IvozProvider\Klear\Auth\MainOperators;

use IvozProvider\Mapper\Sql\MainOperators;
use IvozProvider\Model\Brands;

class Mapper extends \IvozProvider\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new MainOperators();
    }

    protected function _populateCustomPerms(\IvozProvider\Klear\Auth\User $user, $operator)
    {
        $user->isMainOperator = true;

        $user->canSeeMain = true;
        $user->canSeeBrand = true;
        $user->canSeeCompany = true;

        return $user;
    }
}
