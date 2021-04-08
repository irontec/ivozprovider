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
     * @var \DateTime
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
     * @param mixed $id
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

    protected function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    protected function setTimingType(?string $timingType = null): static
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

    public function getTimingType(): ?string
    {
        return $this->timingType;
    }

    protected function setTimeIn($timeIn): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): \DateTime
    {
        return clone $this->timeIn;
    }

    protected function setMonday(?bool $monday = null): static
    {
        if (!is_null($monday)) {
            Assertion::between(intval($monday), 0, 1, 'monday provided "%s" is not a valid boolean value.');
            $monday = (bool) $monday;
        }

        $this->monday = $monday;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    protected function setTuesday(?bool $tuesday = null): static
    {
        if (!is_null($tuesday)) {
            Assertion::between(intval($tuesday), 0, 1, 'tuesday provided "%s" is not a valid boolean value.');
            $tuesday = (bool) $tuesday;
        }

        $this->tuesday = $tuesday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    protected function setWednesday(?bool $wednesday = null): static
    {
        if (!is_null($wednesday)) {
            Assertion::between(intval($wednesday), 0, 1, 'wednesday provided "%s" is not a valid boolean value.');
            $wednesday = (bool) $wednesday;
        }

        $this->wednesday = $wednesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    protected function setThursday(?bool $thursday = null): static
    {
        if (!is_null($thursday)) {
            Assertion::between(intval($thursday), 0, 1, 'thursday provided "%s" is not a valid boolean value.');
            $thursday = (bool) $thursday;
        }

        $this->thursday = $thursday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    protected function setFriday(?bool $friday = null): static
    {
        if (!is_null($friday)) {
            Assertion::between(intval($friday), 0, 1, 'friday provided "%s" is not a valid boolean value.');
            $friday = (bool) $friday;
        }

        $this->friday = $friday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    protected function setSaturday(?bool $saturday = null): static
    {
        if (!is_null($saturday)) {
            Assertion::between(intval($saturday), 0, 1, 'saturday provided "%s" is not a valid boolean value.');
            $saturday = (bool) $saturday;
        }

        $this->saturday = $saturday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    protected function setSunday(?bool $sunday = null): static
    {
        if (!is_null($sunday)) {
            Assertion::between(intval($sunday), 0, 1, 'sunday provided "%s" is not a valid boolean value.');
            $sunday = (bool) $sunday;
        }

        $this->sunday = $sunday;

        return $this;
    }

    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    public function setRatingPlanGroup(RatingPlanGroupInterface $ratingPlanGroup): static
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        /** @var  $this */
        return $this;
    }

    public function getRatingPlanGroup(): RatingPlanGroupInterface
    {
        return $this->ratingPlanGroup;
    }

    protected function setDestinationRateGroup(DestinationRateGroupInterface $destinationRateGroup): static
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    public function getDestinationRateGroup(): DestinationRateGroupInterface
    {
        return $this->destinationRateGroup;
    }
}
