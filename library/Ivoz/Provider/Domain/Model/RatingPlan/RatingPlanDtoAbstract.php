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
     * @var string|null
     */
    private $timingType = 'always';

    /**
     * @var \DateTimeInterface|string
     */
    private $timeIn;

    /**
     * @var bool|null
     */
    private $monday = true;

    /**
     * @var bool|null
     */
    private $tuesday = true;

    /**
     * @var bool|null
     */
    private $wednesday = true;

    /**
     * @var bool|null
     */
    private $thursday = true;

    /**
     * @var bool|null
     */
    private $friday = true;

    /**
     * @var bool|null
     */
    private $saturday = true;

    /**
     * @var bool|null
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
    public static function getPropertyMap(string $context = '', string $role = null): array
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

    public function toArray(bool $hideSensitiveData = false): array
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

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setTimingType(?string $timingType): static
    {
        $this->timingType = $timingType;

        return $this;
    }

    public function getTimingType(): ?string
    {
        return $this->timingType;
    }

    public function setTimeIn(\DateTimeInterface|string $timeIn): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): \DateTimeInterface|string|null
    {
        return $this->timeIn;
    }

    public function setMonday(?bool $monday): static
    {
        $this->monday = $monday;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    public function setTuesday(?bool $tuesday): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    public function setWednesday(?bool $wednesday): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    public function setThursday(?bool $thursday): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    public function setFriday(?bool $friday): static
    {
        $this->friday = $friday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    public function setSaturday(?bool $saturday): static
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    public function setSunday(?bool $sunday): static
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRatingPlanGroup(?RatingPlanGroupDto $ratingPlanGroup): static
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    public function getRatingPlanGroup(): ?RatingPlanGroupDto
    {
        return $this->ratingPlanGroup;
    }

    public function setRatingPlanGroupId($id): static
    {
        $value = !is_null($id)
            ? new RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDestinationRateGroup(?DestinationRateGroupDto $destinationRateGroup): static
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    public function getDestinationRateGroup(): ?DestinationRateGroupDto
    {
        return $this->destinationRateGroup;
    }

    public function setDestinationRateGroupId($id): static
    {
        $value = !is_null($id)
            ? new DestinationRateGroupDto($id)
            : null;

        return $this->setDestinationRateGroup($value);
    }

    public function getDestinationRateGroupId()
    {
        if ($dto = $this->getDestinationRateGroup()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTpTiming(?TpTimingDto $tpTiming): static
    {
        $this->tpTiming = $tpTiming;

        return $this;
    }

    public function getTpTiming(): ?TpTimingDto
    {
        return $this->tpTiming;
    }

    public function setTpTimingId($id): static
    {
        $value = !is_null($id)
            ? new TpTimingDto($id)
            : null;

        return $this->setTpTiming($value);
    }

    public function getTpTimingId()
    {
        if ($dto = $this->getTpTiming()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTpRatingPlan(?TpRatingPlanDto $tpRatingPlan): static
    {
        $this->tpRatingPlan = $tpRatingPlan;

        return $this;
    }

    public function getTpRatingPlan(): ?TpRatingPlanDto
    {
        return $this->tpRatingPlan;
    }

    public function setTpRatingPlanId($id): static
    {
        $value = !is_null($id)
            ? new TpRatingPlanDto($id)
            : null;

        return $this->setTpRatingPlan($value);
    }

    public function getTpRatingPlanId()
    {
        if ($dto = $this->getTpRatingPlan()) {
            return $dto->getId();
        }

        return null;
    }
}
