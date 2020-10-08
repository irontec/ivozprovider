<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface AdministratorInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * @inheritdoc
     */
    public function setPass($pass = null);

    /**
     * @return bool
     */
    public function isSuperAdmin();

    /**
     * @return bool
     */
    public function isBrandAdmin(): bool;

    public function isVpbxAdmin(): bool;

    public function isResidentialAdmin(): bool;

    public function isRetailAdmin(): bool;

    public function isWholesaleAdmin(): bool;

    public function companyHasFeature(string $iden): bool;

    public function brandHasFeature(string $iden): bool;

    public function serialize();

    public function unserialize($serialized);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass(): string;

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive(): bool;

    /**
     * Get restricted
     *
     * @return boolean
     */
    public function getRestricted(): bool;

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName();

    /**
     * Get lastname
     *
     * @return string | null
     */
    public function getLastname();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getTimezone();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relPublicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity
     *
     * @return static
     */
    public function addRelPublicEntity(\Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity);

    /**
     * Remove relPublicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity
     */
    public function removeRelPublicEntity(\Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity);

    /**
     * Replace relPublicEntities
     *
     * @param ArrayCollection $relPublicEntities of Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface
     * @return static
     */
    public function replaceRelPublicEntities(ArrayCollection $relPublicEntities);

    /**
     * Get relPublicEntities
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface[]
     */
    public function getRelPublicEntities(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles(): array;

    public function hasAccessPrivileges(string $fqdn, string $reqMethod): bool;

    /**
     * @see AdvancedUserInterface::getPassword()
     */
    public function getPassword(): string;

    /**
     * @see AdvancedUserInterface::isEnabled()
     */
    public function isEnabled(): bool;

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt(): string;

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials();
}
