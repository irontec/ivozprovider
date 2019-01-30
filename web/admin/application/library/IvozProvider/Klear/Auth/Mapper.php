<?php
namespace IvozProvider\Klear\Auth;

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDTO;
use Ivoz\Provider\Domain\Model\Feature\Feature;

abstract class Mapper implements \Klear_Auth_Adapter_Interfaces_BasicUserMapper
{
    /**
     * @var Brands
     */
    protected $_brand;

    /**
     * @var DataGateway
     */
    protected $dataGateway;

    public function __construct()
    {
        /** @var DataGateway $dataGateway */
        $this->dataGateway = \Zend_Registry::get('data_gateway');
    }

    public function setBrand(BrandDTO $brand)
    {
        $this->_brand = $brand;
    }

    /**
     * @param string $login
     * @return Klear_Auth_Adapter_Interfaces_BasicUserModel
     */
    public function findByLogin($login)
    {
        $this->findByLoginAndBrand($login);
    }

    /**
     * @param string $login
     * @param null | BrandDTO $brand
     * @return Klear_Auth_Adapter_Interfaces_BasicUserModel
     */
    public function findByLoginAndBrand($login, BrandDTO $brand = null)
    {
        $administrator = $this->dataGateway->findOneBy(
            Administrator::class,
            [
                "Administrator.username = '$login'".
                " AND " .
                "Administrator.active = 1"
            ]
        );

        if (is_object($administrator)) {
            $user = new User();
            $this->_poblateUser($user, $administrator);
            $this->_populateCustomPerms($user, $administrator);

            return $user;
        }

        return null;
    }

    protected function _poblateUser(User $user, $operator)
    {
        /**
         * @var TimezoneDTO $operatorTz
         */
        $operatorTz = $this->dataGateway->find(
            Timezone::class,
            $operator->getTimezoneId()
        );

        $user
            ->setId($operator->getId())
            ->setUserName($operator->getName(). ' '. $operator->getLastName())
            ->setLogin($operator->getUsername())
            ->setEmail($operator->getEmail())
            ->setPassword($operator->getPass())
            ->setActive($operator->getActive())
            ->setTimezone($operatorTz->getTz());

        if (isset($this->_brand)) {
            $user->setBrandId($this->_brand->getId());
        }

        return $this;
    }

    protected function _enableFeatures($user, $entity)
    {
        // Enable/disable features
        $features = $this->dataGateway->findAll(
            Feature::class
        );

        foreach ($features as $feature) {
            $featureName = $feature->getIden();
            $featureId = $feature->getId();

            $entityClass = substr(
                get_class($entity),
                0,
                strlen('DTO') * -1
            );

            $enabled = $this->dataGateway->remoteProcedureCall(
                $entityClass,
                $entity->getId(),
                'hasFeature',
                [$featureId]
            );

            $features[$featureName] = array(
                "enabled" => $enabled,
                "disabled" => !$enabled
            );
        }

        if ($entity instanceof BrandDTO) {
            $user->setBrandFeatures($features);
        } elseif ($entity instanceof CompanyDTO) {
            $user->setCompanyFeatures($features);
        } else {
            throw new \Exception('Brand or Company DTO was expected');
        }
    }

    abstract protected function _populateCustomPerms(\IvozProvider\Klear\Auth\User $user, $operator);
}
