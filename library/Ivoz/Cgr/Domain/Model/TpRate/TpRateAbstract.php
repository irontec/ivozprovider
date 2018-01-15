<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TpRateAbstract
 * @codeCoverageIgnore
 */
abstract class TpRateAbstract
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
     * @column connect_fee
     * @var string
     */
    protected $connectFee;

    /**
     * @column rate
     * @var string
     */
    protected $rateCost;

    /**
     * @column rate_unit
     * @var string
     */
    protected $rateUnit = '60s';

    /**
     * @column rate_increment
     * @var string
     */
    protected $rateIncrement;

    /**
     * @column group_interval_start
     * @var string
     */
    protected $groupIntervalStart = '0s';

    /**
     * @column created_at
     * @var \DateTime
     */
    protected $createdAt;

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
        $connectFee,
        $rateCost,
        $rateUnit,
        $rateIncrement,
        $groupIntervalStart,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setConnectFee($connectFee);
        $this->setRateCost($rateCost);
        $this->setRateUnit($rateUnit);
        $this->setRateIncrement($rateIncrement);
        $this->setGroupIntervalStart($groupIntervalStart);
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
     * @return TpRateDTO
     */
    public static function createDTO()
    {
        return new TpRateDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRateDTO
         */
        Assertion::isInstanceOf($dto, TpRateDTO::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getConnectFee(),
            $dto->getRateCost(),
            $dto->getRateUnit(),
            $dto->getRateIncrement(),
            $dto->getGroupIntervalStart(),
            $dto->getCreatedAt());

        $self
            ->setTag($dto->getTag())
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
         * @var $dto TpRateDTO
         */
        Assertion::isInstanceOf($dto, TpRateDTO::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setConnectFee($dto->getConnectFee())
            ->setRateCost($dto->getRateCost())
            ->setRateUnit($dto->getRateUnit())
            ->setRateIncrement($dto->getRateIncrement())
            ->setGroupIntervalStart($dto->getGroupIntervalStart())
            ->setCreatedAt($dto->getCreatedAt())
            ->setRate($dto->getRate());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return TpRateDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setTpid($this->getTpid())
            ->setTag($this->getTag())
            ->setConnectFee($this->getConnectFee())
            ->setRateCost($this->getRateCost())
            ->setRateUnit($this->getRateUnit())
            ->setRateIncrement($this->getRateIncrement())
            ->setGroupIntervalStart($this->getGroupIntervalStart())
            ->setCreatedAt($this->getCreatedAt())
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
            'connect_fee' => self::getConnectFee(),
            'rate' => self::getRateCost(),
            'rate_unit' => self::getRateUnit(),
            'rate_increment' => self::getRateIncrement(),
            'group_interval_start' => self::getGroupIntervalStart(),
            'created_at' => self::getCreatedAt(),
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
     * Set connectFee
     *
     * @param string $connectFee
     *
     * @return self
     */
    public function setConnectFee($connectFee)
    {
        Assertion::notNull($connectFee, 'connectFee value "%s" is null, but non null value was expected.');
        Assertion::numeric($connectFee);

        $this->connectFee = $connectFee;

        return $this;
    }

    /**
     * Get connectFee
     *
     * @return string
     */
    public function getConnectFee()
    {
        return $this->connectFee;
    }

    /**
     * Set rateCost
     *
     * @param string $rateCost
     *
     * @return self
     */
    public function setRateCost($rateCost)
    {
        Assertion::notNull($rateCost, 'rateCost value "%s" is null, but non null value was expected.');
        Assertion::numeric($rateCost);

        $this->rateCost = $rateCost;

        return $this;
    }

    /**
     * Get rateCost
     *
     * @return string
     */
    public function getRateCost()
    {
        return $this->rateCost;
    }

    /**
     * Set rateUnit
     *
     * @param string $rateUnit
     *
     * @return self
     */
    public function setRateUnit($rateUnit)
    {
        Assertion::notNull($rateUnit, 'rateUnit value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rateUnit, 16, 'rateUnit value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rateUnit = $rateUnit;

        return $this;
    }

    /**
     * Get rateUnit
     *
     * @return string
     */
    public function getRateUnit()
    {
        return $this->rateUnit;
    }

    /**
     * Set rateIncrement
     *
     * @param string $rateIncrement
     *
     * @return self
     */
    public function setRateIncrement($rateIncrement)
    {
        Assertion::notNull($rateIncrement, 'rateIncrement value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rateIncrement, 16, 'rateIncrement value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    /**
     * Get rateIncrement
     *
     * @return string
     */
    public function getRateIncrement()
    {
        return $this->rateIncrement;
    }

    /**
     * Set groupIntervalStart
     *
     * @param string $groupIntervalStart
     *
     * @return self
     */
    public function setGroupIntervalStart($groupIntervalStart)
    {
        Assertion::notNull($groupIntervalStart, 'groupIntervalStart value "%s" is null, but non null value was expected.');
        Assertion::maxLength($groupIntervalStart, 16, 'groupIntervalStart value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    /**
     * Get groupIntervalStart
     *
     * @return string
     */
    public function getGroupIntervalStart()
    {
        return $this->groupIntervalStart;
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

