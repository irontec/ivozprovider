<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * column: destrates_tag
     * @var string
     */
    protected $destratesTag;

    /**
     * column: timing_tag
     * @var string
     */
    protected $timingTag = '*any';

    /**
     * @var string
     */
    protected $weight = 10;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * column: timing_type
     * comment: enum:always|custom
     * @var string
     */
    protected $timingType = 'always';

    /**
     * column: time_in
     * @var \DateTime
     */
    protected $timeIn;

    /**
     * @var boolean
     */
    protected $monday = '1';

    /**
     * @var boolean
     */
    protected $tuesday = '1';

    /**
     * @var boolean
     */
    protected $wednesday = '1';

    /**
     * @var boolean
     */
    protected $thursday = '1';

    /**
     * @var boolean
     */
    protected $friday = '1';

    /**
     * @var boolean
     */
    protected $saturday = '1';

    /**
     * @var boolean
     */
    protected $sunday = '1';

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface
     */
    protected $timing;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    protected $ratingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface
     */
    protected $destinationRateGroup;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $timingTag,
        $weight,
        $createdAt,
        $timeIn
    ) {
        $this->setTpid($tpid);
        $this->setTimingTag($timingTag);
        $this->setWeight($weight);
        $this->setCreatedAt($createdAt);
        $this->setTimeIn($timeIn);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TpRatingPlan",
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
     * @return TpRatingPlanDto
     */
    public static function createDto($id = null)
    {
        return new TpRatingPlanDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpRatingPlanDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpRatingPlanInterface::class);

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
         * @var $dto TpRatingPlanDto
         */
        Assertion::isInstanceOf($dto, TpRatingPlanDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getTimingTag(),
            $dto->getWeight(),
            $dto->getCreatedAt(),
            $dto->getTimeIn());

        $self
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setTimingType($dto->getTimingType())
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setTiming($dto->getTiming())
            ->setRatingPlan($dto->getRatingPlan())
            ->setDestinationRateGroup($dto->getDestinationRateGroup())
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
         * @var $dto TpRatingPlanDto
         */
        Assertion::isInstanceOf($dto, TpRatingPlanDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setTimingTag($dto->getTimingTag())
            ->setWeight($dto->getWeight())
            ->setCreatedAt($dto->getCreatedAt())
            ->setTimingType($dto->getTimingType())
            ->setTimeIn($dto->getTimeIn())
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setTiming($dto->getTiming())
            ->setRatingPlan($dto->getRatingPlan())
            ->setDestinationRateGroup($dto->getDestinationRateGroup());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TpRatingPlanDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setDestratesTag(self::getDestratesTag())
            ->setTimingTag(self::getTimingTag())
            ->setWeight(self::getWeight())
            ->setCreatedAt(self::getCreatedAt())
            ->setTimingType(self::getTimingType())
            ->setTimeIn(self::getTimeIn())
            ->setMonday(self::getMonday())
            ->setTuesday(self::getTuesday())
            ->setWednesday(self::getWednesday())
            ->setThursday(self::getThursday())
            ->setFriday(self::getFriday())
            ->setSaturday(self::getSaturday())
            ->setSunday(self::getSunday())
            ->setTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTiming::entityToDto(self::getTiming(), $depth))
            ->setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan::entityToDto(self::getRatingPlan(), $depth))
            ->setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup::entityToDto(self::getDestinationRateGroup(), $depth));
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
            'timing_type' => self::getTimingType(),
            'time_in' => self::getTimeIn(),
            'monday' => self::getMonday(),
            'tuesday' => self::getTuesday(),
            'wednesday' => self::getWednesday(),
            'thursday' => self::getThursday(),
            'friday' => self::getFriday(),
            'saturday' => self::getSaturday(),
            'sunday' => self::getSunday(),
            'timingId' => self::getTiming() ? self::getTiming()->getId() : null,
            'ratingPlanId' => self::getRatingPlan() ? self::getRatingPlan()->getId() : null,
            'destinationRateGroupId' => self::getDestinationRateGroup() ? self::getDestinationRateGroup()->getId() : null
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
     * @deprecated
     * Set timingTag
     *
     * @param string $timingTag
     *
     * @return self
     */
    public function setTimingTag($timingTag)
    {
        Assertion::notNull($timingTag, 'timingTag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($timingTag, 64, 'timingTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @deprecated
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
        $weight = (float) $weight;

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
     * @deprecated
     * Set timingType
     *
     * @param string $timingType
     *
     * @return self
     */
    public function setTimingType($timingType = null)
    {
        if (!is_null($timingType)) {
            Assertion::maxLength($timingType, 10, 'timingType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($timingType, array (
          0 => 'always',
          1 => 'custom',
        ), 'timingTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->timingType = $timingType;

        return $this;
    }

    /**
     * Get timingType
     *
     * @return string
     */
    public function getTimingType()
    {
        return $this->timingType;
    }

    /**
     * @deprecated
     * Set timeIn
     *
     * @param \DateTime $timeIn
     *
     * @return self
     */
    public function setTimeIn($timeIn)
    {
        Assertion::notNull($timeIn, 'timeIn value "%s" is null, but non null value was expected.');

        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @deprecated
     * Set monday
     *
     * @param boolean $monday
     *
     * @return self
     */
    public function setMonday($monday = null)
    {
        if (!is_null($monday)) {
            Assertion::between(intval($monday), 0, 1, 'monday provided "%s" is not a valid boolean value.');
        }

        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return boolean
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * @deprecated
     * Set tuesday
     *
     * @param boolean $tuesday
     *
     * @return self
     */
    public function setTuesday($tuesday = null)
    {
        if (!is_null($tuesday)) {
            Assertion::between(intval($tuesday), 0, 1, 'tuesday provided "%s" is not a valid boolean value.');
        }

        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return boolean
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @deprecated
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return self
     */
    public function setWednesday($wednesday = null)
    {
        if (!is_null($wednesday)) {
            Assertion::between(intval($wednesday), 0, 1, 'wednesday provided "%s" is not a valid boolean value.');
        }

        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return boolean
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @deprecated
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return self
     */
    public function setThursday($thursday = null)
    {
        if (!is_null($thursday)) {
            Assertion::between(intval($thursday), 0, 1, 'thursday provided "%s" is not a valid boolean value.');
        }

        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return boolean
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * @deprecated
     * Set friday
     *
     * @param boolean $friday
     *
     * @return self
     */
    public function setFriday($friday = null)
    {
        if (!is_null($friday)) {
            Assertion::between(intval($friday), 0, 1, 'friday provided "%s" is not a valid boolean value.');
        }

        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return boolean
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * @deprecated
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return self
     */
    public function setSaturday($saturday = null)
    {
        if (!is_null($saturday)) {
            Assertion::between(intval($saturday), 0, 1, 'saturday provided "%s" is not a valid boolean value.');
        }

        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return boolean
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * @deprecated
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return self
     */
    public function setSunday($sunday = null)
    {
        if (!is_null($sunday)) {
            Assertion::between(intval($sunday), 0, 1, 'sunday provided "%s" is not a valid boolean value.');
        }

        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return boolean
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * Set timing
     *
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing
     *
     * @return self
     */
    public function setTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface $timing = null)
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
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return self
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan)
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }

    /**
     * Set destinationRateGroup
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup
     *
     * @return self
     */
    public function setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface $destinationRateGroup)
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    /**
     * Get destinationRateGroup
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface
     */
    public function getDestinationRateGroup()
    {
        return $this->destinationRateGroup;
    }



    // @codeCoverageIgnoreEnd
}

