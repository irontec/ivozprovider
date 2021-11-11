<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* TrunksUacregInterface
*/
interface TrunksUacregInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy(string $authProxy): static;

    /**
     * @inheritdoc
     */
    public function setLUuid(string $lUuid): static;

    public static function createDto(string|int|null $id = null): TrunksUacregDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksUacregInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksUacregDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksUacregDto;

    public function getLUuid(): string;

    public function getLUsername(): string;

    public function getLDomain(): string;

    public function getRUsername(): string;

    public function getRDomain(): string;

    public function getRealm(): string;

    public function getAuthUsername(): string;

    public function getAuthPassword(): string;

    public function getAuthProxy(): string;

    public function getExpires(): int;

    public function getFlags(): int;

    public function getRegDelay(): int;

    public function getAuthHa1(): string;

    public function getSocket(): string;

    public function getContactAddr(): string;

    public function setDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): static;

    public function getDdiProviderRegistration(): DdiProviderRegistrationInterface;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;
}
