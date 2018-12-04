<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RatingPlanDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $weight = 10;

    /**
     * @var string
     */
    private $timingType = 'always';

    /**
     * @var \DateTime
     */
    private $timeIn;

    /**
     * @var boolean
     */
    private $monday = '1';

    /**
     * @var boolean
     */
    private $tuesday = '1';

    /**
     * @var boolean
     */
    private $wednesday = '1';

    /**
     * @var boolean
     */
    private $thursday = '1';

    /**
     * @var boolean
     */
    private $friday = '1';

    /**
     * @var boolean
     */
    private $saturday = '1';

    /**
     * @var boolean
     */
    private $sunday = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto | null
     */
    private $ratingPlanGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto | null
     */
    private $destinationRateGroup;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto | null
     */
    private $tpTiming;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto | null
     */
    private $tpRatingPlan;


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
            'weight' => 'weight',
            'timingType' => 'timingType',
            'timeIn' => 'timeIn',
            'monday' => 'monday',
            'tuesday' => 'tuesday',
            'wednesday' => 'wednesday',
            'thursday' => 'thursday',
            'friday' => 'friday',
            'saturday' => 'saturday',
            'sunday' => 'sunday',
            'id' => 'id',
            'ratingPlanGroupId' => 'ratingPlanGroup',
            'destinationRateGroupId' => 'destinationRateGroup',
            'tpTimingId' => 'tpTiming',
            'tpRatingPlanId' => 'tpRatingPlan'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'weight' => $this->getWeight(),
            'timingType' => $this->getTimingType(),
            'timeIn' => $this->getTimeIn(),
            'monday' => $this->getMonday(),
            'tuesday' => $this->getTuesday(),
            'wednesday' => $this->getWednesday(),
            'thursday' => $this->getThursday(),
            'friday' => $this->getFriday(),
            'saturday' => $this->getSaturday(),
            'sunday' => $this->getSunday(),
            'id' => $this->getId(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'destinationRateGroup' => $this->getDestinationRateGroup(),
            'tpTiming' => $this->getTpTiming(),
            'tpRatingPlan' => $this->getTpRatingPlan()
        ];
    }

    /**
     * @param string $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $timingType
     *
     * @return static
     */
    public function setTimingType($timingType = null)
    {
        $this->timingType = $timingType;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimingType()
    {
        return $this->timingType;
    }

    /**
     * @param \DateTime $timeIn
     *
     * @return static
     */
    public function setTimeIn($timeIn = null)
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param boolean $monday
     *
     * @return static
     */
    public function setMonday($monday = null)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * @param boolean $tuesday
     *
     * @return static
     */
    public function setTuesday($tuesday = null)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @param boolean $wednesday
     *
     * @return static
     */
    public function setWednesday($wednesday = null)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @param boolean $thursday
     *
     * @return static
     */
    public function setThursday($thursday = null)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * @param boolean $friday
     *
     * @return static
     */
    public function setFriday($friday = null)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * @param boolean $saturday
     *
     * @return static
     */
    public function setSaturday($saturday = null)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * @param boolean $sunday
     *
     * @return static
     */
    public function setSunday($sunday = null)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSunday()
    {
        return $this->sunday;
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
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto $ratingPlanGroup
     *
     * @return static
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto $ratingPlanGroup = null)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRatingPlanGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto $destinationRateGroup
     *
     * @return static
     */
    public function setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto $destinationRateGroup = null)
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto
     */
    public function getDestinationRateGroup()
    {
        return $this->destinationRateGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDestinationRateGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto($id)
            : null;

        return $this->setDestinationRateGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getDestinationRateGroupId()
    {
        if ($dto = $this->getDestinationRateGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto $tpTiming
     *
     * @return static
     */
    public function setTpTiming(\Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto $tpTiming = null)
    {
        $this->tpTiming = $tpTiming;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto
     */
    public function getTpTiming()
    {
        return $this->tpTiming;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTpTimingId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto($id)
            : null;

        return $this->setTpTiming($value);
    }

    /**
     * @return integer | null
     */
    public function getTpTimingId()
    {
        if ($dto = $this->getTpTiming()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto $tpRatingPlan
     *
     * @return static
     */
    public function setTpRatingPlan(\Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto $tpRatingPlan = null)
    {
        $this->tpRatingPlan = $tpRatingPlan;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto
     */
    public function getTpRatingPlan()
    {
        return $this->tpRatingPlan;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTpRatingPlanId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto($id)
            : null;

        return $this->setTpRatingPlan($value);
    }

    /**
     * @return integer | null
     */
    public function getTpRatingPlanId()
    {
        if ($dto = $this->getTpRatingPlan()) {
            return $dto->getId();
        }

        return null;
    }
}
