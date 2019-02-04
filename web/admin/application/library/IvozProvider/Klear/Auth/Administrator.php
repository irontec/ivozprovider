<?php
namespace IvozProvider\Klear\Auth;

use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;

use Ivoz\Provider\Domain\Model\Administrator\Administrator as AdministratorEntity;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorDTO;

class Administrator extends Mapper
{
    /**
     * @param string $login
     * @param null | BrandDTO $brand
     * @return Klear_Auth_Adapter_Interfaces_BasicUserModel
     */
    public function findByLoginAndBrand($login, BrandDTO $brand = null)
    {
        $query = ['Administrator.username = :username', 'Administrator.active = 1'];
        $queryArguments = ['username' => $login];

        if (is_null($brand)) {
            $query[] = 'Administrator.brand IS NULL';
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
     * @param AdministratorDTO $operator
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
        }

        return $user;
    }
}
