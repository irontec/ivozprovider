<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* AdministratorInterface
*/
interface AdministratorInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * @inheritdoc
     */
    public function setPass(string $pass = null): AdministratorInterface;

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
     * @return bool
     */
    public function getActive(): bool;

    /**
     * Get restricted
     *
     * @return bool
     */
    public function getRestricted(): bool;

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName(): ?string;

    /**
     * Get lastname
     *
     * @return string | null
     */
    public function getLastname(): ?string;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get timezone
     *
     * @return TimezoneInterface | null
     */
    public function getTimezone(): ?TimezoneInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relPublicEntity
     *
     * @param AdministratorRelPublicEntityInterface $relPublicEntity
     *
     * @return static
     */
    public function addRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface;

    /**
     * Remove relPublicEntity
     *
     * @param AdministratorRelPublicEntityInterface $relPublicEntity
     *
     * @return static
     */
    public function removeRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface;

    /**
     * Replace relPublicEntities
     *
     * @param ArrayCollection $relPublicEntities of AdministratorRelPublicEntityInterface
     *
     * @return static
     */
    public function replaceRelPublicEntities(ArrayCollection $relPublicEntities): AdministratorInterface;

    /**
     * Get relPublicEntities
     * @param Criteria | null $criteria
     * @return AdministratorRelPublicEntityInterface[]
     */
    public function getRelPublicEntities(?Criteria $criteria = null): array;

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles(): array;

    public function hasAccessPrivileges(string $fqdn, string $reqMethod): bool;

    /**
     * @see UserInterface::getPassword()
     */
    public function getPassword(): string;

    public function isEnabled(): bool;

    /**
     * @see UserInterface::getSalt()
     */
    public function getSalt(): string;

    /**
     * @see UserInterface::eraseCredentials()
     */
    public function eraseCredentials();

}
