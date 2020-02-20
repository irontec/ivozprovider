<?php
namespace IvozProvider\Klear\Auth;

use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntity;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;

use Ivoz\Provider\Domain\Model\Administrator\Administrator as AdministratorEntity;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorDto;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntity;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityDto;

class Administrator extends Mapper
{
    /**
     * @param string $login
     * @param null | BrandDto $brand
     * @return Klear_Auth_Adapter_Interfaces_BasicUserModel
     */
    public function findByLoginAndBrand($login, BrandDto $brand = null)
    {
        $query = [
            'Administrator.username = :username',
            'Administrator.active = 1',
            '(Administrator.restricted = 0 OR Administrator.company IS NOT NULL)'
        ];
        $queryArguments = ['username' => $login];

        if (is_null($brand)) {
            $query[] = 'Administrator.brand IS NULL ';
            $query[] = 'Administrator.company IS NULL';
        } else {
            $query[] = 'Administrator.brand = :brandId';
            $queryArguments['brandId'] = $brand->getId();
        }

        $administrator = $this->dataGateway->findOneBy(
            AdministratorEntity::class,
            [
                implode(' AND ', $query),
                $queryArguments
            ]
        );

        if (!$administrator) {
            return null;
        }

        $user = new \IvozProvider\Klear\Auth\User();
        $this->_poblateUser($user, $administrator);
        $this->_populateCustomPerms($user, $administrator);

        if ($user->isMainOperator) {
            return $user;
        }

        $this->_enableFeatures($user, $user->getBrand());
        if ($user->isCompanyAdmin) {
            $this->_enableFeatures($user, $user->getCompany());
        }

        return $user;
    }


    /**
     * @param User $user
     * @param AdministratorDto $operator
     * @return User
     */
    protected function _populateCustomPerms(\IvozProvider\Klear\Auth\User $user, $operator)
    {
        $isMainOperator = is_null($operator->getBrandId()) && is_null($operator->getCompanyId());
        $isBrandOperator = !is_null($operator->getBrandId()) && is_null($operator->getCompanyId());
        $isCompanyAdmin = !is_null($operator->getCompanyId());

        $user->isMainOperator = $isMainOperator;
        $user->canSeeMain = $isMainOperator;
        $user->canSeeBrand = $isMainOperator || $isBrandOperator;
        $user->canSeeCompany = true;

        $this->_loadAcls($user);

        if ($isBrandOperator) {
            $brand = $this->dataGateway->find(
                Brand::class,
                $operator->getBrandId()
            );

            $user->isBrandOperator = true;
            $user->setBrand($brand);
        } elseif ($isCompanyAdmin) {
            $company = $this->dataGateway->find(
                Company::class,
                $operator->getCompanyId()
            );

            $user->isCompanyAdmin = true;
            $user->setCompany($company);
            $this->_loadOperatorAcls($user, $operator);
        }

        return $user;
    }

    protected function _loadAcls(\IvozProvider\Klear\Auth\User $user)
    {
        /** @var PublicEntityDto[] $publicEntities */
        $publicEntities = $this->dataGateway->findAll(
            PublicEntity::class
        );

        foreach ($publicEntities as $entity) {
            $user->acls[$entity->getIden()] = [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ];
        }
    }

    protected function _loadOperatorAcls(\IvozProvider\Klear\Auth\User $user, AdministratorDto $administrator)
    {
        /** @var AdministratorRelPublicEntityDto[] $administratorRelPublicEntities */
        $administratorRelPublicEntities = $this->dataGateway->findBy(
            AdministratorRelPublicEntity::class,
            [
                'AdministratorRelPublicEntity.administrator = :adminId',
                [
                    'adminId' => $administrator->getId()
                ]
            ]
        );

        $adminPublicEntityIds = [];
        foreach ($administratorRelPublicEntities as $acl) {
            $adminPublicEntityIds[] = $acl->getPublicEntityId();
        }

        /** @var PublicEntityDto[] $adminPublicEntityIds */
        $adminPublicEntities = $this->dataGateway->findBy(
            PublicEntity::class,
            [
                'PublicEntity.id IN (:ids)',
                [
                    'ids' => $adminPublicEntityIds
                ]
            ]
        );

        $adminAcls = [];
        foreach ($administratorRelPublicEntities as $acl) {

            /** @var PublicEntityDto $targetEntity */
            $targetEntity = null;
            foreach ($adminPublicEntities as $publicEntity) {
                if ($publicEntity->getId() !== $acl->getPublicEntityId()) {
                    continue;
                }

                $targetEntity = $publicEntity;
                break;
            }

            if (!$targetEntity) {
                throw new \Exception(
                    'Unable to find an entity for AdministratorRelPublicEntity #' . $acl->getId()
                );
            }

            $adminAcls[$targetEntity->getIden()] = [
                'create' => $acl->getCreate(),
                'read' => $acl->getRead(),
                'update' => $acl->getUpdate(),
                'delete' => $acl->getDelete(),
            ];
        }

        foreach ($adminAcls as $iden => $accessPrivileges) {
            $user->acls[$iden] = $accessPrivileges;
        }
    }
}
