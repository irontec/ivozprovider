<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpTimingDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $years;

    /**
     * @var string
     */
    private $months;

    /**
     * @var string
     */
    private $monthDays;

    /**
     * @var string
     */
    private $weekDays;

    /**
     * @var string
     */
    private $time = '00:00:00';

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto | null
     */
    private $ratingPlan;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'tpid' => 'tpid',
            'tag' => 'tag',
            'years' => 'years',
            'months' => 'months',
            'monthDays' => 'monthDays',
            'weekDays' => 'weekDays',
            'time' => 'time',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'ratingPlanId' => 'ratingPlan'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'years' => $this->getYears(),
            'months' => $this->getMonths(),
            'monthDays' => $this->getMonthDays(),
            'weekDays' => $this->getWeekDays(),
            'time' => $this->getTime(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'ratingPlan' => $this->getRatingPlan()
        ];
    }

    /**
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $tag
     *
     * @return static
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $years
     *
     * @return static
     */
    public function setYears($years = null)
    {
        $this->years = $years;

        return $this;
    }

    /**
     * @return string
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param string $months
     *
     * @return static
     */
    public function setMonths($months = null)
    {
        $this->months = $months;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * @param string $monthDays
     *
     * @return static
     */
    public function setMonthDays($monthDays = null)
    {
        $this->monthDays = $monthDays;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonthDays()
    {
        return $this->monthDays;
    }

    /**
     * @param string $weekDays
     *
     * @return static
     */
    public function setWeekDays($weekDays = null)
    {
        $this->weekDays = $weekDays;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeekDays()
    {
        return $this->weekDays;
    }

    /**
     * @param string $time
     *
     * @return static
     */
    public function setTime($time = null)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto $ratingPlan
     *
     * @return static
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto $ratingPlan = null)
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRatingPlanId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto($id)
            : null;

        return $this->setRatingPlan($value);
    }

    /**
     * @return integer | null
     */
    public function getRatingPlanId()
    {
        if ($dto = $this->getRatingPlan()) {
            return $dto->getId();
        }

        return null;
    }
}
