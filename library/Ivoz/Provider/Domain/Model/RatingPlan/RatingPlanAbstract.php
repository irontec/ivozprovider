<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var ?string
     * column: timing_type
     * comment: enum:always|custom
     */
    protected $timingType = 'always';

    /**
     * @var \DateTimeInterface
     * column: time_in
     */
    protected $timeIn;

    /**
     * @var ?bool
     */
    protected $monday = true;

    /**
     * @var ?bool
     */
    protected $tuesday = true;

    /**
     * @var ?bool
     */
    protected $wednesday = true;

    /**
     * @var ?bool
     */
    protected $thursday = true;

    /**
     * @var ?bool
     */
    protected $friday = true;

    /**
     * @var ?bool
     */
    protected $saturday = true;

    /**
     * @var ?bool
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
        float $weight,
        \DateTimeInterface|string $timeIn
    ) {
        $this->setWeight($weight);
        $this->setTimeIn($timeIn);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "RatingPlan",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): RatingPlanDto
    {
        return new RatingPlanDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|RatingPlanInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RatingPlanDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingPlanDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function toDto(int $depth = 0): RatingPlanDto
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

    protected function __toArray(): array
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

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeIn(): \DateTimeInterface
    {
        return clone $this->timeIn;
    }

    protected function setMonday(?bool $monday = null): static
    {
        $this->monday = $monday;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    protected function setTuesday(?bool $tuesday = null): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    protected function setWednesday(?bool $wednesday = null): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    protected function setThursday(?bool $thursday = null): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    protected function setFriday(?bool $friday = null): static
    {
        $this->friday = $friday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    protected function setSaturday(?bool $saturday = null): static
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    protected function setSunday(?bool $sunday = null): static
    {
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
