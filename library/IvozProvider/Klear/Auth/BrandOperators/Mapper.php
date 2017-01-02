<?php
namespace IvozProvider\Klear\Auth\BrandOperators;

use IvozProvider\Mapper\Sql\BrandOperators;

class Mapper extends \IvozProvider\Klear\Auth\Mapper
{
    public function __construct()
    {
        $this->_mapper = new BrandOperators();
    }

    public function findByLogin($login)
    {
        $brandOperators = $this->_mapper->fetchList(array('username=? and active=1',array($login)));

        foreach ($brandOperators as $brandOperator) {
            if ($brandOperator->getBrandId() === $this->_brand->getId()) {
                $user = new \IvozProvider\Klear\Auth\User();
                $this->_poblateUser($user, $brandOperator);
                $this->_populateCustomPerms($user, $brandOperator);
                return $user;
            }
        }

        return null;
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