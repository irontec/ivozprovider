<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

/**
* DdiProviderRegistrationInterface
*/
interface DdiProviderRegistrationInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): DdiProviderRegistrationDto;

    /**
     * @internal use EntityTools instead
     * @param null|DdiProviderRegistrationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiProviderRegistrationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiProviderRegistrationDto;

    public function getUsername(): string;

    public function getDomain(): string;

    public function getRealm(): string;

    public function getAuthUsername(): string;

    public function getAuthPassword(): string;

    public function getAuthProxy(): string;

    public function getExpires(): int;

    public function getMultiDdi(): ?bool;

    public function getContactUsername(): string;

    public function setDdiProvider(DdiProviderInterface $ddiProvider): static;

    public function getDdiProvider(): DdiProviderInterface;

    public function isInitialized(): bool;

    public function setTrunksUacreg(TrunksUacregInterface $trunksUacreg): static;

    public function getTrunksUacreg(): ?TrunksUacregInterface;
}
