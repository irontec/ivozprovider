<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;

/**
* RatingPlanDtoAbstract
* @codeCoverageIgnore
*/
abstract class RatingPlanDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var float
     */
    private $weight = 10;

    /**
     * @var string | null
     */
    private $timingType = 'always';

    /**
     * @var \DateTimeInterface
     */
    private $timeIn;

    /**
     * @var bool | null
     */
    private $monday = true;

    /**
     * @var bool | null
     */
    private $tuesday = true;

    /**
     * @var bool | null
     */
    private $wednesday = true;

    /**
     * @var bool | null
     */
    private $thursday = true;

    /**
     * @var bool | null
     */
    private $friday = true;

    /**
     * @var bool | null
     */
    private $saturday = true;

    /**
     * @var bool | null
     */
    private $sunday = true;

    /**
     * @var int
     */
    private $id;

    /**
     * @var RatingPlanGroupDto | null
     */
    private $ratingPlanGroup;

    /**
     * @var DestinationRateGroupDto | null
     */
    private $destinationRateGroup;

    /**
     * @var TpTimingDto | null
     */
    private $tpTiming;

    /**
     * @var TpRatingPlanDto | null
     */
    private $tpRatingPlan;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param float $weight | null
     *
     * @return static
     */
    public function setWeight(?float $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param string $timingType | null
     *
     * @return static
     */
    public function setTimingType(?string $timingType = null): self
    {
        $this->timingType = $timingType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTimingType(): ?string
    {
        return $this->timingType;
    }

    /**
     * @param \DateTimeInterface $timeIn | null
     *
     * @return static
     */
    public function setTimeIn($timeIn = null): self
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param bool $monday | null
     *
     * @return static
     */
    public function setMonday(?bool $monday = null): self
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    /**
     * @param bool $tuesday | null
     *
     * @return static
     */
    public function setTuesday(?bool $tuesday = null): self
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    /**
     * @param bool $wednesday | null
     *
     * @return static
     */
    public function setWednesday(?bool $wednesday = null): self
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    /**
     * @param bool $thursday | null
     *
     * @return static
     */
    public function setThursday(?bool $thursday = null): self
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    /**
     * @param bool $friday | null
     *
     * @return static
     */
    public function setFriday(?bool $friday = null): self
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    /**
     * @param bool $saturday | null
     *
     * @return static
     */
    public function setSaturday(?bool $saturday = null): self
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    /**
     * @param bool $sunday | null
     *
     * @return static
     */
    public function setSunday(?bool $sunday = null): self
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param RatingPlanGroupDto | null
     *
     * @return static
     */
    public function setRatingPlanGroup(?RatingPlanGroupDto $ratingPlanGroup = null): self
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return RatingPlanGroupDto | null
     */
    public function getRatingPlanGroup(): ?RatingPlanGroupDto
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @return static
     */
    public function setRatingPlanGroupId($id): self
    {
        $value = !is_null($id)
            ? new RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DestinationRateGroupDto | null
     *
     * @return static
     */
    public function setDestinationRateGroup(?DestinationRateGroupDto $destinationRateGroup = null): self
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    /**
     * @return DestinationRateGroupDto | null
     */
    public function getDestinationRateGroup(): ?DestinationRateGroupDto
    {
        return $this->destinationRateGroup;
    }

    /**
     * @return static
     */
    public function setDestinationRateGroupId($id): self
    {
        $value = !is_null($id)
            ? new DestinationRateGroupDto($id)
            : null;

        return $this->setDestinationRateGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getDestinationRateGroupId()
    {
        if ($dto = $this->getDestinationRateGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TpTimingDto | null
     *
     * @return static
     */
    public function setTpTiming(?TpTimingDto $tpTiming = null): self
    {
        $this->tpTiming = $tpTiming;

        return $this;
    }

    /**
     * @return TpTimingDto | null
     */
    public function getTpTiming(): ?TpTimingDto
    {
        return $this->tpTiming;
    }

    /**
     * @return static
     */
    public function setTpTimingId($id): self
    {
        $value = !is_null($id)
            ? new TpTimingDto($id)
            : null;

        return $this->setTpTiming($value);
    }

    /**
     * @return mixed | null
     */
    public function getTpTimingId()
    {
        if ($dto = $this->getTpTiming()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TpRatingPlanDto | null
     *
     * @return static
     */
    public function setTpRatingPlan(?TpRatingPlanDto $tpRatingPlan = null): self
    {
        $this->tpRatingPlan = $tpRatingPlan;

        return $this;
    }

    /**
     * @return TpRatingPlanDto | null
     */
    public function getTpRatingPlan(): ?TpRatingPlanDto
    {
        return $this->tpRatingPlan;
    }

    /**
     * @return static
     */
    public function setTpRatingPlanId($id): self
    {
        $value = !is_null($id)
            ? new TpRatingPlanDto($id)
            : null;

        return $this->setTpRatingPlan($value);
    }

    /**
     * @return mixed | null
     */
    public function getTpRatingPlanId()
    {
        if ($dto = $this->getTpRatingPlan()) {
            return $dto->getId();
        }

        return null;
    }

}
