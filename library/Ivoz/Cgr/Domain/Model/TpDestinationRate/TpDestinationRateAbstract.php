<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;

/**
* TpDestinationRateAbstract
* @codeCoverageIgnore
*/
abstract class TpDestinationRateAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * column: destinations_tag
     * @var string | null
     */
    protected $destinationsTag;

    /**
     * column: rates_tag
     * @var string | null
     */
    protected $ratesTag;

    /**
     * column: rounding_method
     * comment: enum:*up|*upmincost
     * @var string
     */
    protected $roundingMethod = '*up';

    /**
     * column: rounding_decimals
     * @var int
     */
    protected $roundingDecimals = 4;

    /**
     * column: max_cost
     * @var float
     */
    protected $maxCost = 0;

    /**
     * column: max_cost_strategy
     * @var string
     */
    protected $maxCostStrategy = '';

    /**
     * column: created_at
     * @var \DateTimeInterface
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var DestinationRate
     * inversedBy tpDestinationRate
     */
    protected $destinationRate;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $roundingMethod,
        $roundingDecimals,
        $maxCost,
        $maxCostStrategy,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setRoundingMethod($roundingMethod);
        $this->setRoundingDecimals($roundingDecimals);
        $this->setMaxCost($maxCost);
        $this->setMaxCostStrategy($maxCostStrategy);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpDestinationRate",
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
     * @param null $id
     * @return TpDestinationRateDto
     */
    public static function createDto($id = null)
    {
        return new TpDestinationRateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpDestinationRateInterface|null $entity
     * @param int $depth
     * @return TpDestinationRateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpDestinationRateInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TpDestinationRateDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpDestinationRateDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpDestinationRateDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getRoundingMethod(),
            $dto->getRoundingDecimals(),
            $dto->getMaxCost(),
            $dto->getMaxCostStrategy(),
            $dto->getCreatedAt()
        );

        $self
            ->setTag($dto->getTag())
            ->setDestinationsTag($dto->getDestinationsTag())
            ->setRatesTag($dto->getRatesTag())
            ->setDestinationRate($fkTransformer->transform($dto->getDestinationRate()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpDestinationRateDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpDestinationRateDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setDestinationsTag($dto->getDestinationsTag())
            ->setRatesTag($dto->getRatesTag())
            ->setRoundingMethod($dto->getRoundingMethod())
            ->setRoundingDecimals($dto->getRoundingDecimals())
            ->setMaxCost($dto->getMaxCost())
            ->setMaxCostStrategy($dto->getMaxCostStrategy())
            ->setCreatedAt($dto->getCreatedAt())
            ->setDestinationRate($fkTransformer->transform($dto->getDestinationRate()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpDestinationRateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setDestinationsTag(self::getDestinationsTag())
            ->setRatesTag(self::getRatesTag())
            ->setRoundingMethod(self::getRoundingMethod())
            ->setRoundingDecimals(self::getRoundingDecimals())
            ->setMaxCost(self::getMaxCost())
            ->setMaxCostStrategy(self::getMaxCostStrategy())
            ->setCreatedAt(self::getCreatedAt())
            ->setDestinationRate(DestinationRate::entityToDto(self::getDestinationRate(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'destinations_tag' => self::getDestinationsTag(),
            'rates_tag' => self::getRatesTag(),
            'rounding_method' => self::getRoundingMethod(),
            'rounding_decimals' => self::getRoundingDecimals(),
            'max_cost' => self::getMaxCost(),
            'max_cost_strategy' => self::getMaxCostStrategy(),
            'created_at' => self::getCreatedAt(),
            'destinationRateId' => self::getDestinationRate()->getId()
        ];
    }

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return static
     */
    protected function setTpid(string $tpid): TpDestinationRateInterface
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid(): string
    {
        return $this->tpid;
    }

    /**
     * Set tag
     *
     * @param string $tag | null
     *
     * @return static
     */
    protected function setTag(?string $tag = null): TpDestinationRateInterface
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * Set destinationsTag
     *
     * @param string $destinationsTag | null
     *
     * @return static
     */
    protected function setDestinationsTag(?string $destinationsTag = null): TpDestinationRateInterface
    {
        if (!is_null($destinationsTag)) {
            Assertion::maxLength($destinationsTag, 64, 'destinationsTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationsTag = $destinationsTag;

        return $this;
    }

    /**
     * Get destinationsTag
     *
     * @return string | null
     */
    public function getDestinationsTag(): ?string
    {
        return $this->destinationsTag;
    }

    /**
     * Set ratesTag
     *
     * @param string $ratesTag | null
     *
     * @return static
     */
    protected function setRatesTag(?string $ratesTag = null): TpDestinationRateInterface
    {
        if (!is_null($ratesTag)) {
            Assertion::maxLength($ratesTag, 64, 'ratesTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ratesTag = $ratesTag;

        return $this;
    }

    /**
     * Get ratesTag
     *
     * @return string | null
     */
    public function getRatesTag(): ?string
    {
        return $this->ratesTag;
    }

    /**
     * Set roundingMethod
     *
     * @param string $roundingMethod
     *
     * @return static
     */
    protected function setRoundingMethod(string $roundingMethod): TpDestinationRateInterface
    {
        Assertion::maxLength($roundingMethod, 255, 'roundingMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $roundingMethod,
            [
                TpDestinationRateInterface::ROUNDINGMETHOD_UP,
                TpDestinationRateInterface::ROUNDINGMETHOD_UPMINCOST,
            ],
            'roundingMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->roundingMethod = $roundingMethod;

        return $this;
    }

    /**
     * Get roundingMethod
     *
     * @return string
     */
    public function getRoundingMethod(): string
    {
        return $this->roundingMethod;
    }

    /**
     * Set roundingDecimals
     *
     * @param int $roundingDecimals
     *
     * @return static
     */
    protected function setRoundingDecimals(int $roundingDecimals): TpDestinationRateInterface
    {
        $this->roundingDecimals = $roundingDecimals;

        return $this;
    }

    /**
     * Get roundingDecimals
     *
     * @return int
     */
    public function getRoundingDecimals(): int
    {
        return $this->roundingDecimals;
    }

    /**
     * Set maxCost
     *
     * @param float $maxCost
     *
     * @return static
     */
    protected function setMaxCost(float $maxCost): TpDestinationRateInterface
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * Get maxCost
     *
     * @return float
     */
    public function getMaxCost(): float
    {
        return $this->maxCost;
    }

    /**
     * Set maxCostStrategy
     *
     * @param string $maxCostStrategy
     *
     * @return static
     */
    protected function setMaxCostStrategy(string $maxCostStrategy): TpDestinationRateInterface
    {
        Assertion::maxLength($maxCostStrategy, 16, 'maxCostStrategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->maxCostStrategy = $maxCostStrategy;

        return $this;
    }

    /**
     * Get maxCostStrategy
     *
     * @return string
     */
    public function getMaxCostStrategy(): string
    {
        return $this->maxCostStrategy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInterface $createdAt
     *
     * @return static
     */
    protected function setCreatedAt($createdAt): TpDestinationRateInterface
    {

        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return clone $this->createdAt;
    }

    /**
     * Set destinationRate
     *
     * @param DestinationRate
     *
     * @return static
     */
    public function setDestinationRate(DestinationRate $destinationRate): TpDestinationRateInterface
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * Get destinationRate
     *
     * @return DestinationRate
     */
    public function getDestinationRate(): DestinationRate
    {
        return $this->destinationRate;
    }

}
