<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $tpid = 'ivozprovider';

    protected $tag;

    protected $years;

    protected $months;

    /**
     * column: month_days
     */
    protected $monthDays;

    /**
     * column: week_days
     */
    protected $weekDays;

    protected $time = '00:00:00';

    /**
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

        $self = new static(
            $dto->getTpid(),
            $dto->getYears(),
            $dto->getMonths(),
            $dto->getMonthDays(),
            $dto->getWeekDays(),
            $dto->getTime(),
            $dto->getCreatedAt()
        );

        $self
            ->setTag($dto->getTag())
            ->setRatingPlan($fkTransformer->transform($dto->getRatingPlan()));

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

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setYears($dto->getYears())
            ->setMonths($dto->getMonths())
            ->setMonthDays($dto->getMonthDays())
            ->setWeekDays($dto->getWeekDays())
            ->setTime($dto->getTime())
            ->setCreatedAt($dto->getCreatedAt())
            ->setRatingPlan($fkTransformer->transform($dto->getRatingPlan()));

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

    protected function setCreatedAt($createdAt): static
    {

        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface
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
