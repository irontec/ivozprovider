<?php

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* ChannelUsageInterface
*/
interface ChannelUsageInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ChannelUsageDto;

    /**
     * @internal use EntityTools instead
     * @param null|ChannelUsageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ChannelUsageDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ChannelUsageDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ChannelUsageDto;

    public function getTimestamp(): \DateTime;

    public function getPeak(): int;

    public function getAvgUsage(): float;

    public function getClosingUsage(): int;

    public function getMaxCallsCompany(): int;

    public function getMaxCallsBrand(): int;

    public function getBlockedByCompanyLimit(): int;

    public function getBlockedByBrandLimit(): int;

    public function getBrand(): BrandInterface;

    public function getCompany(): CompanyInterface;
}
