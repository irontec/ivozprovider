<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup;

/**
* RatingPlanAbstract
* @codeCoverageIgnore
*/
abstract class RatingPlanAbstract
{
    use ChangelogTrait;

    /**
     * @var float
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
     * @var \DateTimeInterface
     */
    protected $timeIn;

    /**
     * @var bool | null
     */
    protected $monday = true;

    /**
     * @var bool | null
     */
    protected $tuesday = true;

    /**
     * @var bool | null
     */
    protected $wednesday = true;

    /**
     * @var bool | null
     */
    protected $thursday = true;

    /**
     * @var bool | null
     */
    protected $friday = true;

    /**
     * @var bool | null
     */
    protected $saturday = true;

    /**
     * @var bool | null
     */
    protected $sunday = true;

    /**
     * @var RatingPlanGroupInterface
     * inversedBy ratingPlan
     */
    protected $ratingPlanGroup;

    /**
     * @var DestinationRateGroupInterface
     */
    protected $destinationRateGroup;

    /**
     * Constructor
     */
    protected function __construct(
        $weight,
        $timeIn
    ) {
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
     * @param RatingPlanInterface|null $entity
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

        /** @var RatingPlanDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setDestinationRateGroup($fkTransformer->transform($dto->getDestinationRateGroup()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RatingPlanDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setDestinationRateGroup($fkTransformer->transform($dto->getDestinationRateGroup()));

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
            ->setRatingPlanGroup(RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setDestinationRateGroup(DestinationRateGroup::entityToDto(self::getDestinationRateGroup(), $depth));
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
            'ratingPlanGroupId' => self::getRatingPlanGroup()->getId(),
            'destinationRateGroupId' => self::getDestinationRateGroup()->getId()
        ];
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return static
     */
    protected function setWeight(float $weight): RatingPlanInterface
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * Set timingType
     *
     * @param string $timingType | null
     *
     * @return static
     */
    protected function setTimingType(?string $timingType = null): RatingPlanInterface
    {
        if (!is_null($timingType)) {
            Assertion::maxLength($timingType, 10, 'timingType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $timingType,
                [
                    RatingPlanInterface::TIMINGTYPE_ALWAYS,
                    RatingPlanInterface::TIMINGTYPE_CUSTOM,
                ],
                'timingTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->timingType = $timingType;

        return $this;
    }

    /**
     * Get timingType
     *
     * @return string | null
     */
    public function getTimingType(): ?string
    {
        return $this->timingType;
    }

    /**
     * Set timeIn
     *
     * @param \DateTimeInterface $timeIn
     *
     * @return static
     */
    protected function setTimeIn($timeIn): RatingPlanInterface
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get timeIn
     *
     * @return \DateTimeInterface
     */
    public function getTimeIn(): \DateTimeInterface
    {
        return clone $this->timeIn;
    }

    /**
     * Set monday
     *
     * @param bool $monday | null
     *
     * @return static
     */
    protected function setMonday(?bool $monday = null): RatingPlanInterface
    {
        if (!is_null($monday)) {
            Assertion::between(intval($monday), 0, 1, 'monday provided "%s" is not a valid boolean value.');
            $monday = (bool) $monday;
        }

        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return bool | null
     */
    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param bool $tuesday | null
     *
     * @return static
     */
    protected function setTuesday(?bool $tuesday = null): RatingPlanInterface
    {
        if (!is_null($tuesday)) {
            Assertion::between(intval($tuesday), 0, 1, 'tuesday provided "%s" is not a valid boolean value.');
            $tuesday = (bool) $tuesday;
        }

        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return bool | null
     */
    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param bool $wednesday | null
     *
     * @return static
     */
    protected function setWednesday(?bool $wednesday = null): RatingPlanInterface
    {
        if (!is_null($wednesday)) {
            Assertion::between(intval($wednesday), 0, 1, 'wednesday provided "%s" is not a valid boolean value.');
            $wednesday = (bool) $wednesday;
        }

        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return bool | null
     */
    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param bool $thursday | null
     *
     * @return static
     */
    protected function setThursday(?bool $thursday = null): RatingPlanInterface
    {
        if (!is_null($thursday)) {
            Assertion::between(intval($thursday), 0, 1, 'thursday provided "%s" is not a valid boolean value.');
            $thursday = (bool) $thursday;
        }

        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return bool | null
     */
    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param bool $friday | null
     *
     * @return static
     */
    protected function setFriday(?bool $friday = null): RatingPlanInterface
    {
        if (!is_null($friday)) {
            Assertion::between(intval($friday), 0, 1, 'friday provided "%s" is not a valid boolean value.');
            $friday = (bool) $friday;
        }

        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return bool | null
     */
    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param bool $saturday | null
     *
     * @return static
     */
    protected function setSaturday(?bool $saturday = null): RatingPlanInterface
    {
        if (!is_null($saturday)) {
            Assertion::between(intval($saturday), 0, 1, 'saturday provided "%s" is not a valid boolean value.');
            $saturday = (bool) $saturday;
        }

        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return bool | null
     */
    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param bool $sunday | null
     *
     * @return static
     */
    protected function setSunday(?bool $sunday = null): RatingPlanInterface
    {
        if (!is_null($sunday)) {
            Assertion::between(intval($sunday), 0, 1, 'sunday provided "%s" is not a valid boolean value.');
            $sunday = (bool) $sunday;
        }

        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return bool | null
     */
    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param RatingPlanGroupInterface
     *
     * @return static
     */
    public function setRatingPlanGroup(RatingPlanGroupInterface $ratingPlanGroup): RatingPlanInterface
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return RatingPlanGroupInterface
     */
    public function getRatingPlanGroup(): RatingPlanGroupInterface
    {
        return $this->ratingPlanGroup;
    }

    /**
     * Set destinationRateGroup
     *
     * @param DestinationRateGroupInterface
     *
     * @return static
     */
    protected function setDestinationRateGroup(DestinationRateGroupInterface $destinationRateGroup): RatingPlanInterface
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    /**
     * Get destinationRateGroup
     *
     * @return DestinationRateGroupInterface
     */
    public function getDestinationRateGroup(): DestinationRateGroupInterface
    {
        return $this->destinationRateGroup;
    }

}
