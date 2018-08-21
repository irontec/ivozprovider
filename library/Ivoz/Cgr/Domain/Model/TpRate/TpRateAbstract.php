<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * column: connect_fee
     * @var string
     */
    protected $connectFee;

    /**
     * column: rate
     * @var string
     */
    protected $rateCost;

    /**
     * column: rate_unit
     * @var string
     */
    protected $rateUnit = '60s';

    /**
     * column: rate_increment
     * @var string
     */
    protected $rateIncrement;

    /**
     * column: group_interval_start
     * @var string
     */
    protected $groupIntervalStart = '0s';

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface
     */
    protected $destinationRate;


    use ChangelogTrait;

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

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TpRate",
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
     * @return TpRateDto
     */
    public static function createDto($id = null)
    {
        return new TpRateDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpRateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpRateInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRateDto
         */
        Assertion::isInstanceOf($dto, TpRateDto::class);

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
            ->setDestinationRate($dto->getDestinationRate())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRateDto
         */
        Assertion::isInstanceOf($dto, TpRateDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setConnectFee($dto->getConnectFee())
            ->setRateCost($dto->getRateCost())
            ->setRateUnit($dto->getRateUnit())
            ->setRateIncrement($dto->getRateIncrement())
            ->setGroupIntervalStart($dto->getGroupIntervalStart())
            ->setCreatedAt($dto->getCreatedAt())
            ->setDestinationRate($dto->getDestinationRate());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TpRateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setConnectFee(self::getConnectFee())
            ->setRateCost(self::getRateCost())
            ->setRateUnit(self::getRateUnit())
            ->setRateIncrement(self::getRateIncrement())
            ->setGroupIntervalStart(self::getGroupIntervalStart())
            ->setCreatedAt(self::getCreatedAt())
            ->setDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate::entityToDto(self::getDestinationRate(), $depth));
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
            'destinationRateId' => self::getDestinationRate() ? self::getDestinationRate()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
        $connectFee = (float) $connectFee;

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
     * @deprecated
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
        $rateCost = (float) $rateCost;

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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return self
     */
    public function setDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate)
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * Get destinationRate
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface
     */
    public function getDestinationRate()
    {
        return $this->destinationRate;
    }



    // @codeCoverageIgnoreEnd
}

