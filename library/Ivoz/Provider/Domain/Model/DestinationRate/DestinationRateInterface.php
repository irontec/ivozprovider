<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

/**
* DestinationRateInterface
*/
interface DestinationRateInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
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
     * @return string
     */
    public function getCgrTag(): string;

    /**
     * @return string
     */
    public function getCgrRatesTag(): string;

    /**
     * @return string
     */
    public function getCgrDestinationsTag(): string;

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setConnectFee(float $connectFee): static;

    /**
     * Ensure Valid connectFee format
     *
     * @inheritdoc
     */
    public function setCost(float $cost): static;

    /**
     * Ensure Group Interval Start has seconds suffix
     *
     * @inheritdoc
     */
    public function setGroupIntervalStart(string $groupIntervalStart): static;

    /**
     * Ensure Rating Increment has seconds suffix
     *
     * @inheritdoc
     */
    public function setRateIncrement(string $rateIncrement): static;

    public static function createDto(string|int|null $id = null): DestinationRateDto;

    /**
     * @internal use EntityTools instead
     * @param null|DestinationRateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DestinationRateDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationRateDto;

    public function getCost(): float;

    public function getConnectFee(): float;

    public function getRateIncrement(): string;

    public function getGroupIntervalStart(): string;

    public function setDestinationRateGroup(DestinationRateGroupInterface $destinationRateGroup): static;

    public function getDestinationRateGroup(): DestinationRateGroupInterface;

    public function setDestination(DestinationInterface $destination): static;

    public function getDestination(): DestinationInterface;

    public function isInitialized(): bool;

    public function setTpRate(TpRateInterface $tpRate): static;

    public function getTpRate(): ?TpRateInterface;

    public function setTpDestinationRate(TpDestinationRateInterface $tpDestinationRate): static;

    public function getTpDestinationRate(): ?TpDestinationRateInterface;
}
