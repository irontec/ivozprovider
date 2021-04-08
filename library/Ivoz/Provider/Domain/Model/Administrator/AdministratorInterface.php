<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

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
    public function setPass(?string $pass = null): static;

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

    public function getUsername(): string;

    public function getPass(): string;

    public function getEmail(): string;

    public function getActive(): bool;

    public function getRestricted(): bool;

    public function getName(): ?string;

    public function getLastname(): ?string;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getTimezone(): ?TimezoneInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface;

    public function removeRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface;

    public function replaceRelPublicEntities(ArrayCollection $relPublicEntities): AdministratorInterface;

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
