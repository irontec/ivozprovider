<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Symfony\Component\Security\Core\User\UserInterface;

trait AdministratorSecurityTrait
{
    abstract public function getId();

    /**
     * @return string
     */
    abstract public function getUsername(): string;

    /**
     * @return string
     */
    abstract public function getEmail(): string;

    /**
     * @return string
     */
    abstract public function getPass(): string;

    /**
     * @return boolean
     */
    abstract public function getActive(): bool;

    /**
     * @return BrandInterface | null
     */
    abstract public function getBrand();

    /**
     * @return CompanyInterface | null
     */
    abstract public function getCompany();

    /**
     * @return boolean
     */
    abstract public function getRestricted(): bool;

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles(): array
    {
        $brand = $this->getBrand();
        $company = $this->getCompany();

        if (is_null($brand) && is_null($company)) {
            return [
                'ROLE_SUPER_ADMIN'
            ];
        }

        if (!is_null($company)) {
            return [
                'ROLE_COMPANY_ADMIN'
            ];
        }

        return [
            'ROLE_BRAND_ADMIN'
        ];
    }

    public function hasAccessPrivileges(string $fqdn, string $reqMethod): bool
    {
        if (!$this->getRestricted()) {
            return true;
        }

        $accessMethods = [
            'POST' => 'create',
            'GET' => 'read',
            'PUT' => 'update',
            'PATCH' => 'update',
            'DELETE' => 'delete'
        ];

        $reqMethod = strtoupper($reqMethod);

        try {
            Assertion::choice(
                $reqMethod,
                array_keys($accessMethods),
                'Request method "%s" is not an element of the valid values: %s'
            );

            $accessMethod = $accessMethods[$reqMethod];

            $criteria = CriteriaHelper::fromArray([
                [$accessMethod, 'eq', 1],
            ]);

            $relPublicEntities = $this
                ->getRelPublicEntities($criteria);

            Assertion::notEmpty($relPublicEntities);

            foreach ($relPublicEntities as $relPublicEntity) {
                $entityFqdn = $relPublicEntity
                    ->getPublicEntity()
                    ->getFqdn();

                if ($entityFqdn === $fqdn) {
                    return true;
                }
            }
        } catch (\Exception) {
            return false;
        }

        return false;
    }

    /**
     * @param Criteria|null $criteria
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface[]
     */
    abstract public function getRelPublicEntities(Criteria $criteria = null): array;

    /**
     * @see UserInterface::getPassword()
     */
    public function getPassword(): string
    {
        return $this->getPass();
    }

    public function isEnabled(): bool
    {
        $isInnerGlobalAdmin = ($this->getId() === 0);
        if ($isInnerGlobalAdmin) {
            return true;
        }

        return $this->getActive();
    }

    /**
     * @see UserInterface::getSalt()
     */
    public function getSalt(): string
    {
        return substr($this->getPassword(), 0, 29);
    }

    /**
     * @see UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
    }
}
