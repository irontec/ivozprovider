<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;

/**
* TpTimingAbstract
* @codeCoverageIgnore
*/
abstract class TpTimingAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var ?string
     */
    protected $tag = null;

    /**
     * @var string
     */
    protected $years;

    /**
     * @var string
     */
    protected $months;

    /**
     * @var string
     * column: month_days
     */
    protected $monthDays;

    /**
     * @var string
     * column: week_days
     */
    protected $weekDays;

    /**
     * @var string
     */
    protected $time = '00:00:00';

    /**
     * @var \DateTime
     * column: created_at
     */
    protected $createdAt;

    /**
     * @var RatingPlanInterface
     * inversedBy tpTiming
     */
    protected $ratingPlan;

    /**
     * Constructor
     */
    protected function __construct(
        string $tpid,
        string $years,
        string $months,
        string $monthDays,
        string $weekDays,
        string $time,
        \DateTimeInterface|string $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setYears($years);
        $this->setMonths($months);
        $this->setMonthDays($monthDays);
        $this->setWeekDays($weekDays);
        $this->setTime($time);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpTiming",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpTimingDto
    {
        return new TpTimingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpTimingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpTimingDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpTimingInterface::class);

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
     * @param TpTimingDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpTimingDto::class);
        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $years = $dto->getYears();
        Assertion::notNull($years, 'getYears value is null, but non null value was expected.');
        $months = $dto->getMonths();
        Assertion::notNull($months, 'getMonths value is null, but non null value was expected.');
        $monthDays = $dto->getMonthDays();
        Assertion::notNull($monthDays, 'getMonthDays value is null, but non null value was expected.');
        $weekDays = $dto->getWeekDays();
        Assertion::notNull($weekDays, 'getWeekDays value is null, but non null value was expected.');
        $time = $dto->getTime();
        Assertion::notNull($time, 'getTime value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $ratingPlan = $dto->getRatingPlan();
        Assertion::notNull($ratingPlan, 'getRatingPlan value is null, but non null value was expected.');

        $self = new static(
            $tpid,
            $years,
            $months,
            $monthDays,
            $weekDays,
            $time,
            $createdAt
        );

        $self
            ->setTag($dto->getTag())
            ->setRatingPlan($fkTransformer->transform($ratingPlan));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpTimingDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpTimingDto::class);

        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $years = $dto->getYears();
        Assertion::notNull($years, 'getYears value is null, but non null value was expected.');
        $months = $dto->getMonths();
        Assertion::notNull($months, 'getMonths value is null, but non null value was expected.');
        $monthDays = $dto->getMonthDays();
        Assertion::notNull($monthDays, 'getMonthDays value is null, but non null value was expected.');
        $weekDays = $dto->getWeekDays();
        Assertion::notNull($weekDays, 'getWeekDays value is null, but non null value was expected.');
        $time = $dto->getTime();
        Assertion::notNull($time, 'getTime value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $ratingPlan = $dto->getRatingPlan();
        Assertion::notNull($ratingPlan, 'getRatingPlan value is null, but non null value was expected.');

        $this
            ->setTpid($tpid)
            ->setTag($dto->getTag())
            ->setYears($years)
            ->setMonths($months)
            ->setMonthDays($monthDays)
            ->setWeekDays($weekDays)
            ->setTime($time)
            ->setCreatedAt($createdAt)
            ->setRatingPlan($fkTransformer->transform($ratingPlan));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpTimingDto
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setYears(self::getYears())
            ->setMonths(self::getMonths())
            ->setMonthDays(self::getMonthDays())
            ->setWeekDays(self::getWeekDays())
            ->setTime(self::getTime())
            ->setCreatedAt(self::getCreatedAt())
            ->setRatingPlan(RatingPlan::entityToDto(self::getRatingPlan(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'years' => self::getYears(),
            'months' => self::getMonths(),
            'month_days' => self::getMonthDays(),
            'week_days' => self::getWeekDays(),
            'time' => self::getTime(),
            'created_at' => self::getCreatedAt(),
            'ratingPlanId' => self::getRatingPlan()->getId()
        ];
    }

    protected function setTpid(string $tpid): static
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): string
    {
        return $this->tpid;
    }

    protected function setTag(?string $tag = null): static
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    protected function setYears(string $years): static
    {
        Assertion::maxLength($years, 255, 'years value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->years = $years;

        return $this;
    }

    public function getYears(): string
    {
        return $this->years;
    }

    protected function setMonths(string $months): static
    {
        Assertion::maxLength($months, 255, 'months value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->months = $months;

        return $this;
    }

    public function getMonths(): string
    {
        return $this->months;
    }

    protected function setMonthDays(string $monthDays): static
    {
        Assertion::maxLength($monthDays, 255, 'monthDays value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->monthDays = $monthDays;

        return $this;
    }

    public function getMonthDays(): string
    {
        return $this->monthDays;
    }

    protected function setWeekDays(string $weekDays): static
    {
        Assertion::maxLength($weekDays, 255, 'weekDays value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->weekDays = $weekDays;

        return $this;
    }

    public function getWeekDays(): string
    {
        return $this->weekDays;
    }

    protected function setTime(string $time): static
    {
        Assertion::maxLength($time, 32, 'time value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->time = $time;

        return $this;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    protected function setCreatedAt(string|\DateTimeInterface $createdAt): static
    {

        /** @var \DateTime */
        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return clone $this->createdAt;
    }

    public function setRatingPlan(RatingPlanInterface $ratingPlan): static
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    public function getRatingPlan(): RatingPlanInterface
    {
        return $this->ratingPlan;
    }
}
