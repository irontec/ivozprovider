<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;

/**
* DdiProviderAddressInterface
*/
interface DdiProviderAddressInterface extends LoggableEntityInterface
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
    public function setIp(?string $ip = null): static;

    public static function createDto(string|int|null $id = null): DdiProviderAddressDto;

    /**
     * @internal use EntityTools instead
     * @param null|DdiProviderAddressInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiProviderAddressDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderAddressDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiProviderAddressDto;

    public function getIp(): ?string;

    public function getDescription(): ?string;

    public function setDdiProvider(DdiProviderInterface $ddiProvider): static;

    public function getDdiProvider(): DdiProviderInterface;

    public function setTrunksAddress(TrunksAddressInterface $trunksAddress): static;

    public function getTrunksAddress(): ?TrunksAddressInterface;
}
