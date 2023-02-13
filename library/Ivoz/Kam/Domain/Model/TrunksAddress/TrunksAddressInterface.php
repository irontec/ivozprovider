<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

/**
* TrunksAddressInterface
*/
interface TrunksAddressInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TrunksAddressDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksAddressInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksAddressDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksAddressDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksAddressDto;

    public function getGrp(): int;

    public function getIpAddr(): ?string;

    public function getMask(): int;

    public function getPort(): int;

    public function getTag(): ?string;

    public function setDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): static;

    public function getDdiProviderAddress(): DdiProviderAddressInterface;
}
