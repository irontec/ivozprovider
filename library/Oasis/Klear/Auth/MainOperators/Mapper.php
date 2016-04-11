<?php
namespace Oasis\Klear\Auth\MainOperators;

use Oasis\Mapper\Sql\MainOperators;
use Oasis\Model\Brands;

class Mapper extends \Oasis\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new MainOperators();
    }

    protected function _populateCustomPerms(\Oasis\Klear\Auth\User $user, $operator)
    {
        $user->isMainOperator = true;
        
        $user->canSeeMain = true;
        $user->canSeeBrand = true;
        $user->canSeeCompany = true;
        
        return $user;
    }
}