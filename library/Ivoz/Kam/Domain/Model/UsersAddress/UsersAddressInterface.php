<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* UsersAddressInterface
*/
interface UsersAddressInterface extends LoggableEntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    public function setIpAddr(?string $ipAddr = null): static;

    public function setMask(?int $mask = null): static;

    public static function createDto(string|int|null $id = null): UsersAddressDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersAddressInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersAddressDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersAddressDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersAddressDto;

    public function getSourceAddress(): string;

    public function getIpAddr(): ?string;

    public function getMask(): int;

    public function getPort(): int;

    public function getTag(): ?string;

    public function getDescription(): ?string;

    public function getCompany(): CompanyInterface;
}
