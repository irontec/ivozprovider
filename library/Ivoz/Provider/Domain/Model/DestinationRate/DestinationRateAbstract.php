<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * column: rate
     * @var float
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
        $cost,
        $connectFee,
        $rateIncrement,
        $groupIntervalStart
    ) {
        $this->setCost($cost);
        $this->setConnectFee($connectFee);
        $this->setRateIncrement($rateIncrement);
        $this->setGroupIntervalStart($groupIntervalStart);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "DestinationRate",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     * @return DestinationRateDto
     */
    public static function createDto($id = null)
    {
        return new DestinationRateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationRateInterface|null $entity
     * @param int $depth
     * @return DestinationRateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var DestinationRateDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return DestinationRateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCost(self::getCost())
            ->setConnectFee(self::getConnectFee())
            ->setRateIncrement(self::getRateIncrement())
            ->setGroupIntervalStart(self::getGroupIntervalStart())
            ->setDestinationRateGroup(DestinationRateGroup::entityToDto(self::getDestinationRateGroup(), $depth))
            ->setDestination(Destination::entityToDto(self::getDestination(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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

        /** @var  $this */
        return $this;
    }

    public function getDestinationRateGroup(): DestinationRateGroupInterface
    {
        return $this->destinationRateGroup;
    }

    public function setDestination(DestinationInterface $destination): static
    {
        $this->destination = $destination;

        /** @var  $this */
        return $this;
    }

    public function getDestination(): DestinationInterface
    {
        return $this->destination;
    }
}
