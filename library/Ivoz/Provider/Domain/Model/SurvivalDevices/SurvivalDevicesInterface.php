<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevices;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* SurvivalDevicesInterface
*/
interface SurvivalDevicesInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): SurvivalDevicesDto;

    /**
     * @internal use EntityTools instead
     * @param null|SurvivalDevicesInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?SurvivalDevicesDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param SurvivalDevicesDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): SurvivalDevicesDto;

    public function getName(): string;

    public function getProxy(): string;

    public function getOutboundProxy(): string;

    public function getUdpPort(): int;

    public function getTcpPort(): int;

    public function getTlsPort(): int;

    public function getWssPort(): int;

    public function getDescription(): string;

    public function getCompany(): CompanyInterface;
}
