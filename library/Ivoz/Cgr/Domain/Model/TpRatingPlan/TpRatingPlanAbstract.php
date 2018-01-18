<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TpRatingPlanAbstract
 * @codeCoverageIgnore
 */
abstract class TpRatingPlanAbstract
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
     * @column destrates_tag
     * @var string
     */
    protected $destratesTag;

    /**
     * @column timing_tag
     * @var string
     */
    protected $timingTag;

    /**
     * @var string
     */
    protected $weight = 10;

    /**
     * @column created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    protected $timing;

    /**
     * @var \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface
     */
    protected $ratingPlan;

    /**
     * @var \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface
     */
    protected $destinationRate;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    protected function __construct($tpid, $weight, $createdAt)
    {
        $this->setTpid($tpid);
        $this->setWeight($weight);
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
     * @return TpRatingPlanDTO
     */
    public static function createDTO()
    {
        return new TpRatingPlanDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRatingPlanDTO
         */
        Assertion::isInstanceOf($dto, TpRatingPlanDTO::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getWeight(),
            $dto->getCreatedAt());

        $self
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setTimingTag($dto->getTimingTag())
            ->setTiming($dto->getTiming())
            ->setRatingPlan($dto->getRatingPlan())
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
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRatingPlanDTO
         */
        Assertion::isInstanceOf($dto, TpRatingPlanDTO::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setTimingTag($dto->getTimingTag())
            ->setWeight($dto->getWeight())
            ->setCreatedAt($dto->getCreatedAt())
            ->setTiming($dto->getTiming())
            ->setRatingPlan($dto->getRatingPlan())
            ->setDestinationRate($dto->getDestinationRate());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return TpRatingPlanDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setTpid($this->getTpid())
            ->setTag($this->getTag())
            ->setDestratesTag($this->getDestratesTag())
            ->setTimingTag($this->getTimingTag())
            ->setWeight($this->getWeight())
            ->setCreatedAt($this->getCreatedAt())
            ->setTimingId($this->getTiming() ? $this->getTiming()->getId() : null)
            ->setRatingPlanId($this->getRatingPlan() ? $this->getRatingPlan()->getId() : null)
            ->setDestinationRateId($this->getDestinationRate() ? $this->getDestinationRate()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'destrates_tag' => self::getDestratesTag(),
            'timing_tag' => self::getTimingTag(),
            'weight' => self::getWeight(),
            'created_at' => self::getCreatedAt(),
            'timingId' => self::getTiming() ? self::getTiming()->getId() : null,
            'ratingPlanId' => self::getRatingPlan() ? self::getRatingPlan()->getId() : null,
            'destinationRateId' => self::getDestinationRate() ? self::getDestinationRate()->getId() : null
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
     * Set destratesTag
     *
     * @param string $destratesTag
     *
     * @return self
     */
    public function setDestratesTag($destratesTag = null)
    {
        if (!is_null($destratesTag)) {
            Assertion::maxLength($destratesTag, 64, 'destratesTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destratesTag = $destratesTag;

        return $this;
    }

    /**
     * Get destratesTag
     *
     * @return string
     */
    public function getDestratesTag()
    {
        return $this->destratesTag;
    }

    /**
     * Set timingTag
     *
     * @param string $timingTag
     *
     * @return self
     */
    public function setTimingTag($timingTag = null)
    {
        if (!is_null($timingTag)) {
            Assertion::maxLength($timingTag, 64, 'timingTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->timingTag = $timingTag;

        return $this;
    }

    /**
     * Get timingTag
     *
     * @return string
     */
    public function getTimingTag()
    {
        return $this->timingTag;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return self
     */
    public function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::numeric($weight);

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
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
     * Set timing
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing
     *
     * @return self
     */
    public function setTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing)
    {
        $this->timing = $timing;

        return $this;
    }

    /**
     * Get timing
     *
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    public function getTiming()
    {
        return $this->timing;
    }

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return self
     */
    public function setRatingPlan(\Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan)
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
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



    // @codeCoverageIgnoreEnd
}

