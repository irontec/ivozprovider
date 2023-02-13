<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* AdministratorInterface
*/
interface AdministratorInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

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

    public function serialize(): string;

    public function unserialize($serialized);

    public static function createDto(string|int|null $id = null): AdministratorDto;

    /**
     * @internal use EntityTools instead
     * @param null|AdministratorInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?AdministratorDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorDto;

    public function getUsername(): string;

    public function getPass(): string;

    public function getEmail(): string;

    public function getActive(): bool;

    public function getInternal(): bool;

    public function getRestricted(): bool;

    public function getName(): ?string;

    public function getLastname(): ?string;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getTimezone(): ?TimezoneInterface;

    public function addRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface;

    public function removeRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface;

    /**
     * @param Collection<array-key, AdministratorRelPublicEntityInterface> $relPublicEntities
     */
    public function replaceRelPublicEntities(Collection $relPublicEntities): AdministratorInterface;

    /**
     * @return array<array-key, AdministratorRelPublicEntityInterface>
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
     *
     * @return void
     */
    public function eraseCredentials();
}
