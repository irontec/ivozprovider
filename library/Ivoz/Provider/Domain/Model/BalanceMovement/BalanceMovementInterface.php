<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

/**
* BalanceMovementInterface
*/
interface BalanceMovementInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): BalanceMovementDto;

    /**
     * @internal use EntityTools instead
     * @param null|BalanceMovementInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BalanceMovementDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BalanceMovementDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BalanceMovementDto;

    public function getAmount(): ?float;

    public function getBalance(): ?float;

    public function getCreatedOn(): ?\DateTime;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;
}
