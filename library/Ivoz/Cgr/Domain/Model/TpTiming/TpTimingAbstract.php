<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpTimingAbstract
 * @codeCoverageIgnore
 */
abstract class TpTimingAbstract
{
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
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    protected $ratingPlan;


    use ChangelogTrait;

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
     * @param EntityInterface|null $entity
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
         * @var $dto TpTimingDto
         */
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
            ->setRatingPlan($dto->getRatingPlan())
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
         * @var $dto TpTimingDto
         */
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
            ->setRatingPlan($dto->getRatingPlan());



        $this->sanitizeValues();
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
            ->setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan::entityToDto(self::getRatingPlan(), $depth));
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
            'ratingPlanId' => self::getRatingPlan() ? self::getRatingPlan()->getId() : null
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
    protected function setTpid($tpid)
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
    protected function setTag($tag = null)
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
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set years
     *
     * @param string $years
     *
     * @return self
     */
    protected function setYears($years)
    {
        Assertion::notNull($years, 'years value "%s" is null, but non null value was expected.');
        Assertion::maxLength($years, 255, 'years value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->years = $years;

        return $this;
    }

    /**
     * Get years
     *
     * @return string
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * Set months
     *
     * @param string $months
     *
     * @return self
     */
    protected function setMonths($months)
    {
        Assertion::notNull($months, 'months value "%s" is null, but non null value was expected.');
        Assertion::maxLength($months, 255, 'months value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->months = $months;

        return $this;
    }

    /**
     * Get months
     *
     * @return string
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * Set monthDays
     *
     * @param string $monthDays
     *
     * @return self
     */
    protected function setMonthDays($monthDays)
    {
        Assertion::notNull($monthDays, 'monthDays value "%s" is null, but non null value was expected.');
        Assertion::maxLength($monthDays, 255, 'monthDays value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->monthDays = $monthDays;

        return $this;
    }

    /**
     * Get monthDays
     *
     * @return string
     */
    public function getMonthDays()
    {
        return $this->monthDays;
    }

    /**
     * Set weekDays
     *
     * @param string $weekDays
     *
     * @return self
     */
    protected function setWeekDays($weekDays)
    {
        Assertion::notNull($weekDays, 'weekDays value "%s" is null, but non null value was expected.');
        Assertion::maxLength($weekDays, 255, 'weekDays value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->weekDays = $weekDays;

        return $this;
    }

    /**
     * Get weekDays
     *
     * @return string
     */
    public function getWeekDays()
    {
        return $this->weekDays;
    }

    /**
     * Set time
     *
     * @param string $time
     *
     * @return self
     */
    protected function setTime($time)
    {
        Assertion::notNull($time, 'time value "%s" is null, but non null value was expected.');
        Assertion::maxLength($time, 32, 'time value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    protected function setCreatedAt($createdAt)
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

    // @codeCoverageIgnoreEnd
}
