<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RatingPlanAbstract
 * @codeCoverageIgnore
 */
abstract class RatingPlanAbstract
{
    /**
     * @var string
     */
    protected $weight = 10;

    /**
     * column: timing_type
     * comment: enum:always|custom
     * @var string | null
     */
    protected $timingType = 'always';

    /**
     * column: time_in
     * @var \DateTime
     */
    protected $timeIn;

    /**
     * @var boolean | null
     */
    protected $monday = '1';

    /**
     * @var boolean | null
     */
    protected $tuesday = '1';

    /**
     * @var boolean | null
     */
    protected $wednesday = '1';

    /**
     * @var boolean | null
     */
    protected $thursday = '1';

    /**
     * @var boolean | null
     */
    protected $friday = '1';

    /**
     * @var boolean | null
     */
    protected $saturday = '1';

    /**
     * @var boolean | null
     */
    protected $sunday = '1';

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface
     */
    protected $destinationRateGroup;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($weight, $timeIn)
    {
        $this->setWeight($weight);
        $this->setTimeIn($timeIn);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "RatingPlan",
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
     * @return RatingPlanDto
     */
    public static function createDto($id = null)
    {
        return new RatingPlanDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return RatingPlanDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RatingPlanInterface::class);

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
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RatingPlanDto
         */
        Assertion::isInstanceOf($dto, RatingPlanDto::class);

        $self = new static(
            $dto->getWeight(),
            $dto->getTimeIn()
        );

        $self
            ->setTimingType($dto->getTimingType())
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setRatingPlanGroup($dto->getRatingPlanGroup())
            ->setDestinationRateGroup($dto->getDestinationRateGroup())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RatingPlanDto
         */
        Assertion::isInstanceOf($dto, RatingPlanDto::class);

        $this
            ->setWeight($dto->getWeight())
            ->setTimingType($dto->getTimingType())
            ->setTimeIn($dto->getTimeIn())
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setRatingPlanGroup($dto->getRatingPlanGroup())
            ->setDestinationRateGroup($dto->getDestinationRateGroup());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RatingPlanDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setWeight(self::getWeight())
            ->setTimingType(self::getTimingType())
            ->setTimeIn(self::getTimeIn())
            ->setMonday(self::getMonday())
            ->setTuesday(self::getTuesday())
            ->setWednesday(self::getWednesday())
            ->setThursday(self::getThursday())
            ->setFriday(self::getFriday())
            ->setSaturday(self::getSaturday())
            ->setSunday(self::getSunday())
            ->setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup::entityToDto(self::getDestinationRateGroup(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'weight' => self::getWeight(),
            'timing_type' => self::getTimingType(),
            'time_in' => self::getTimeIn(),
            'monday' => self::getMonday(),
            'tuesday' => self::getTuesday(),
            'wednesday' => self::getWednesday(),
            'thursday' => self::getThursday(),
            'friday' => self::getFriday(),
            'saturday' => self::getSaturday(),
            'sunday' => self::getSunday(),
            'ratingPlanGroupId' => self::getRatingPlanGroup() ? self::getRatingPlanGroup()->getId() : null,
            'destinationRateGroupId' => self::getDestinationRateGroup() ? self::getDestinationRateGroup()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return self
     */
    protected function setWeight($weight)
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
     * Set timingType
     *
     * @param string $timingType
     *
     * @return self
     */
    protected function setTimingType($timingType = null)
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
     * @return string | null
     */
    public function getTimingType()
    {
        return $this->timingType;
    }

    /**
     * Set timeIn
     *
     * @param \DateTime $timeIn
     *
     * @return self
     */
    protected function setTimeIn($timeIn)
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
     * Set monday
     *
     * @param boolean $monday
     *
     * @return self
     */
    protected function setMonday($monday = null)
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
     * @return boolean | null
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param boolean $tuesday
     *
     * @return self
     */
    protected function setTuesday($tuesday = null)
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
     * @return boolean | null
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return self
     */
    protected function setWednesday($wednesday = null)
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
     * @return boolean | null
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return self
     */
    protected function setThursday($thursday = null)
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
     * @return boolean | null
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param boolean $friday
     *
     * @return self
     */
    protected function setFriday($friday = null)
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
     * @return boolean | null
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return self
     */
    protected function setSaturday($saturday = null)
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
     * @return boolean | null
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return self
     */
    protected function setSunday($sunday = null)
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
     * @return boolean | null
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup
     *
     * @return self
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup = null)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
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
