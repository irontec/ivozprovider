<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
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
     * @var string | null
     */
    protected $tag;

    /**
     * @var string
     */
    protected $years;

    /**
     * @var string
     */
    protected $months;

    /**
     * column: month_days
     * @var string
     */
    protected $monthDays;

    /**
     * column: week_days
     * @var string
     */
    protected $weekDays;

    /**
     * @var string
     */
    protected $time = '00:00:00';

    /**
     * column: created_at
     * @var \DateTimeInterface
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var RatingPlan
     * inversedBy tpTiming
     */
    protected $ratingPlan;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $years,
        $months,
        $monthDays,
        $weekDays,
        $time,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setYears($years);
        $this->setMonths($months);
        $this->setMonthDays($monthDays);
        $this->setWeekDays($weekDays);
        $this->setTime($time);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpTiming",
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
     * @return TpTimingDto
     */
    public static function createDto($id = null)
    {
        return new TpTimingDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpTimingInterface|null $entity
     * @param int $depth
     * @return TpTimingDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var TpTimingDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpTimingDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return TpTimingDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return static
     */
    protected function setTpid(string $tpid): TpTimingInterface
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid(): string
    {
        return $this->tpid;
    }

    /**
     * Set tag
     *
     * @param string $tag | null
     *
     * @return static
     */
    protected function setTag(?string $tag = null): TpTimingInterface
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
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * Set years
     *
     * @param string $years
     *
     * @return static
     */
    protected function setYears(string $years): TpTimingInterface
    {
        Assertion::maxLength($years, 255, 'years value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->years = $years;

        return $this;
    }

    /**
     * Get years
     *
     * @return string
     */
    public function getYears(): string
    {
        return $this->years;
    }

    /**
     * Set months
     *
     * @param string $months
     *
     * @return static
     */
    protected function setMonths(string $months): TpTimingInterface
    {
        Assertion::maxLength($months, 255, 'months value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->months = $months;

        return $this;
    }

    /**
     * Get months
     *
     * @return string
     */
    public function getMonths(): string
    {
        return $this->months;
    }

    /**
     * Set monthDays
     *
     * @param string $monthDays
     *
     * @return static
     */
    protected function setMonthDays(string $monthDays): TpTimingInterface
    {
        Assertion::maxLength($monthDays, 255, 'monthDays value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->monthDays = $monthDays;

        return $this;
    }

    /**
     * Get monthDays
     *
     * @return string
     */
    public function getMonthDays(): string
    {
        return $this->monthDays;
    }

    /**
     * Set weekDays
     *
     * @param string $weekDays
     *
     * @return static
     */
    protected function setWeekDays(string $weekDays): TpTimingInterface
    {
        Assertion::maxLength($weekDays, 255, 'weekDays value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->weekDays = $weekDays;

        return $this;
    }

    /**
     * Get weekDays
     *
     * @return string
     */
    public function getWeekDays(): string
    {
        return $this->weekDays;
    }

    /**
     * Set time
     *
     * @param string $time
     *
     * @return static
     */
    protected function setTime(string $time): TpTimingInterface
    {
        Assertion::maxLength($time, 32, 'time value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInterface $createdAt
     *
     * @return static
     */
    protected function setCreatedAt($createdAt): TpTimingInterface
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
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return clone $this->createdAt;
    }

    /**
     * Set ratingPlan
     *
     * @param RatingPlan
     *
     * @return static
     */
    public function setRatingPlan(RatingPlan $ratingPlan): TpTimingInterface
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * Get ratingPlan
     *
     * @return RatingPlan
     */
    public function getRatingPlan(): RatingPlan
    {
        return $this->ratingPlan;
    }

}
