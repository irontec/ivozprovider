<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup;
use Ivoz\Provider\Domain\Model\Destination\Destination;

/**
* DestinationRateAbstract
* @codeCoverageIgnore
*/
abstract class DestinationRateAbstract
{
    use ChangelogTrait;

    /**
     * @var float
     * column: rate
     */
    protected $cost;

    /**
     * @var float
     */
    protected $connectFee;

    /**
     * @var string
     */
    protected $rateIncrement;

    /**
     * @var string
     */
    protected $groupIntervalStart = '0s';

    /**
     * @var DestinationRateGroupInterface
     * inversedBy destinationRates
     */
    protected $destinationRateGroup;

    /**
     * @var DestinationInterface
     * inversedBy destinationRates
     */
    protected $destination;

    /**
     * Constructor
     */
    protected function __construct(
        float $cost,
        float $connectFee,
        string $rateIncrement,
        string $groupIntervalStart
    ) {
        $this->setCost($cost);
        $this->setConnectFee($connectFee);
        $this->setRateIncrement($rateIncrement);
        $this->setGroupIntervalStart($groupIntervalStart);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "DestinationRate",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): DestinationRateDto
    {
        return new DestinationRateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|DestinationRateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DestinationRateDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DestinationRateInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DestinationRateDto::class);

        $self = new static(
            $dto->getCost(),
            $dto->getConnectFee(),
            $dto->getRateIncrement(),
            $dto->getGroupIntervalStart()
        );

        $self
            ->setDestinationRateGroup($fkTransformer->transform($dto->getDestinationRateGroup()))
            ->setDestination($fkTransformer->transform($dto->getDestination()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationRateDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DestinationRateDto::class);

        $this
            ->setCost($dto->getCost())
            ->setConnectFee($dto->getConnectFee())
            ->setRateIncrement($dto->getRateIncrement())
            ->setGroupIntervalStart($dto->getGroupIntervalStart())
            ->setDestinationRateGroup($fkTransformer->transform($dto->getDestinationRateGroup()))
            ->setDestination($fkTransformer->transform($dto->getDestination()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationRateDto
    {
        return self::createDto()
            ->setCost(self::getCost())
            ->setConnectFee(self::getConnectFee())
            ->setRateIncrement(self::getRateIncrement())
            ->setGroupIntervalStart(self::getGroupIntervalStart())
            ->setDestinationRateGroup(DestinationRateGroup::entityToDto(self::getDestinationRateGroup(), $depth))
            ->setDestination(Destination::entityToDto(self::getDestination(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'rate' => self::getCost(),
            'connectFee' => self::getConnectFee(),
            'rateIncrement' => self::getRateIncrement(),
            'groupIntervalStart' => self::getGroupIntervalStart(),
            'destinationRateGroupId' => self::getDestinationRateGroup()->getId(),
            'destinationId' => self::getDestination()->getId()
        ];
    }

    protected function setCost(float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    protected function setConnectFee(float $connectFee): static
    {
        $this->connectFee = $connectFee;

        return $this;
    }

    public function getConnectFee(): float
    {
        return $this->connectFee;
    }

    protected function setRateIncrement(string $rateIncrement): static
    {
        Assertion::maxLength($rateIncrement, 16, 'rateIncrement value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    public function getRateIncrement(): string
    {
        return $this->rateIncrement;
    }

    protected function setGroupIntervalStart(string $groupIntervalStart): static
    {
        Assertion::maxLength($groupIntervalStart, 16, 'groupIntervalStart value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    public function getGroupIntervalStart(): string
    {
        return $this->groupIntervalStart;
    }

    public function setDestinationRateGroup(DestinationRateGroupInterface $destinationRateGroup): static
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    public function getDestinationRateGroup(): DestinationRateGroupInterface
    {
        return $this->destinationRateGroup;
    }

    public function setDestination(DestinationInterface $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): DestinationInterface
    {
        return $this->destination;
    }
}
