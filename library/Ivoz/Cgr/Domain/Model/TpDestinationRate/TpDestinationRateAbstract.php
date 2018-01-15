<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TpDestinationRateAbstract
 * @codeCoverageIgnore
 */
abstract class TpDestinationRateAbstract
{
    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $tag;

    /**
     * @column destinations_tag
     * @var string
     */
    protected $destinationsTag;

    /**
     * @column rates_tag
     * @var string
     */
    protected $ratesTag;

    /**
     * @column rounding_method
     * @var string
     */
    protected $roundingMethod = '*up';

    /**
     * @column rounding_decimals
     * @var integer
     */
    protected $roundingDecimals = 4;

    /**
     * @column max_cost
     * @var string
     */
    protected $maxCost = '0.000';

    /**
     * @column max_cost_strategy
     * @var string
     */
    protected $maxCostStrategy = '';

    /**
     * @column created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface
     */
    protected $destinationRate;

    /**
     * @var \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface
     */
    protected $destination;

    /**
     * @var \Ivoz\Cgr\Domain\Model\Rate\RateInterface
     */
    protected $rate;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

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

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return TpDestinationRateDTO
     */
    public static function createDTO()
    {
        return new TpDestinationRateDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDestinationRateDTO
         */
        Assertion::isInstanceOf($dto, TpDestinationRateDTO::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getRoundingMethod(),
            $dto->getRoundingDecimals(),
            $dto->getMaxCost(),
            $dto->getMaxCostStrategy(),
            $dto->getCreatedAt());

        $self
            ->setTag($dto->getTag())
            ->setDestinationsTag($dto->getDestinationsTag())
            ->setRatesTag($dto->getRatesTag())
            ->setDestinationRate($dto->getDestinationRate())
            ->setDestination($dto->getDestination())
            ->setRate($dto->getRate())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDestinationRateDTO
         */
        Assertion::isInstanceOf($dto, TpDestinationRateDTO::class);

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
            ->setDestinationRate($dto->getDestinationRate())
            ->setDestination($dto->getDestination())
            ->setRate($dto->getRate());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return TpDestinationRateDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setTpid($this->getTpid())
            ->setTag($this->getTag())
            ->setDestinationsTag($this->getDestinationsTag())
            ->setRatesTag($this->getRatesTag())
            ->setRoundingMethod($this->getRoundingMethod())
            ->setRoundingDecimals($this->getRoundingDecimals())
            ->setMaxCost($this->getMaxCost())
            ->setMaxCostStrategy($this->getMaxCostStrategy())
            ->setCreatedAt($this->getCreatedAt())
            ->setDestinationRateId($this->getDestinationRate() ? $this->getDestinationRate()->getId() : null)
            ->setDestinationId($this->getDestination() ? $this->getDestination()->getId() : null)
            ->setRateId($this->getRate() ? $this->getRate()->getId() : null);
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
            'destinationRateId' => self::getDestinationRate() ? self::getDestinationRate()->getId() : null,
            'destinationId' => self::getDestination() ? self::getDestination()->getId() : null,
            'rateId' => self::getRate() ? self::getRate()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid)
    {
        Assertion::notNull($tpid, 'tpid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
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
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set destinationsTag
     *
     * @param string $destinationsTag
     *
     * @return self
     */
    public function setDestinationsTag($destinationsTag = null)
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
     * @return string
     */
    public function getDestinationsTag()
    {
        return $this->destinationsTag;
    }

    /**
     * Set ratesTag
     *
     * @param string $ratesTag
     *
     * @return self
     */
    public function setRatesTag($ratesTag = null)
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
     * @return string
     */
    public function getRatesTag()
    {
        return $this->ratesTag;
    }

    /**
     * Set roundingMethod
     *
     * @param string $roundingMethod
     *
     * @return self
     */
    public function setRoundingMethod($roundingMethod)
    {
        Assertion::notNull($roundingMethod, 'roundingMethod value "%s" is null, but non null value was expected.');
        Assertion::maxLength($roundingMethod, 255, 'roundingMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->roundingMethod = $roundingMethod;

        return $this;
    }

    /**
     * Get roundingMethod
     *
     * @return string
     */
    public function getRoundingMethod()
    {
        return $this->roundingMethod;
    }

    /**
     * Set roundingDecimals
     *
     * @param integer $roundingDecimals
     *
     * @return self
     */
    public function setRoundingDecimals($roundingDecimals)
    {
        Assertion::notNull($roundingDecimals, 'roundingDecimals value "%s" is null, but non null value was expected.');
        Assertion::integerish($roundingDecimals, 'roundingDecimals value "%s" is not an integer or a number castable to integer.');

        $this->roundingDecimals = $roundingDecimals;

        return $this;
    }

    /**
     * Get roundingDecimals
     *
     * @return integer
     */
    public function getRoundingDecimals()
    {
        return $this->roundingDecimals;
    }

    /**
     * Set maxCost
     *
     * @param string $maxCost
     *
     * @return self
     */
    public function setMaxCost($maxCost)
    {
        Assertion::notNull($maxCost, 'maxCost value "%s" is null, but non null value was expected.');
        Assertion::numeric($maxCost);

        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * Get maxCost
     *
     * @return string
     */
    public function getMaxCost()
    {
        return $this->maxCost;
    }

    /**
     * Set maxCostStrategy
     *
     * @param string $maxCostStrategy
     *
     * @return self
     */
    public function setMaxCostStrategy($maxCostStrategy)
    {
        Assertion::notNull($maxCostStrategy, 'maxCostStrategy value "%s" is null, but non null value was expected.');
        Assertion::maxLength($maxCostStrategy, 16, 'maxCostStrategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->maxCostStrategy = $maxCostStrategy;

        return $this;
    }

    /**
     * Get maxCostStrategy
     *
     * @return string
     */
    public function getMaxCostStrategy()
    {
        return $this->maxCostStrategy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        Assertion::notNull($createdAt, 'createdAt value "%s" is null, but non null value was expected.');
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set destinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return self
     */
    public function setDestinationRate(\Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate)
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate()
    {
        return $this->destinationRate;
    }

    /**
     * Set destination
     *
     * @param \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set rate
     *
     * @param \Ivoz\Cgr\Domain\Model\Rate\RateInterface $rate
     *
     * @return self
     */
    public function setRate(\Ivoz\Cgr\Domain\Model\Rate\RateInterface $rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \Ivoz\Cgr\Domain\Model\Rate\RateInterface
     */
    public function getRate()
    {
        return $this->rate;
    }



    // @codeCoverageIgnoreEnd
}

