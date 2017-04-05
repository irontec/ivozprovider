<?php
namespace IvozProvider\Klear\Auth;

use IvozProvider\Mapper\Sql\MainOperators;
use IvozProvider\Model\Brands;

abstract class Mapper implements \Klear_Auth_Adapter_Interfaces_BasicUserMapper
{
    protected $_mapper;

    /**
     * @var Brands
     */
    protected $_brand;


    public function setBrand(Brands $brand)
    {
        $this->_brand = $brand;
    }


    public function findByLogin($login)
    {
        $userOperator = $this->_mapper->fetchOne(array('username=? and active=1',array($login)));

        if (is_object($userOperator)) {
            $user = new \IvozProvider\Klear\Auth\User();
            $this->_poblateUser($user, $userOperator);
            $this->_populateCustomPerms($user, $userOperator);

            return $user;
        }

        return null;
    }

    protected function _poblateUser(\IvozProvider\Klear\Auth\User $user, $operator)
    {
        $user
            ->setId($operator->getId())
            ->setUserName($operator->getName(). ' '. $operator->getLastName() )
            ->setLogin($operator->getUsername())
            ->setEmail($operator->getEmail())
            ->setPassword($operator->getPass())
            ->setActive($operator->getActive())
            ->setTimezone($operator->getTimezone()->getTz())
            ->setBrandId($this->_brand->getId());
        ;
        return $this;
    }

    protected function _enableFeatures($user, $entity)
    {
        // Enable/disable features
        $features = array();
        $featureMapper = new \IvozProvider\Mapper\Sql\Features;
        foreach ($featureMapper->fetchList() as $feature) {
            $featureName = $feature->getIden();
            $featureId = $feature->getId();
            $enabled = $entity->hasFeature($featureId);
            $features[$featureName] = array(
                "enabled" => $enabled,
                "disabled" => !$enabled
            );
        }

        // Brand or company!
        if ($entity instanceof \IvozProvider\Model\Raw\Brands) {
            $user->brand = $features;
        } else {
            $user->company = $features;
        }
    }

    protected abstract function _populateCustomPerms(\IvozProvider\Klear\Auth\User $user, $operator);

}
