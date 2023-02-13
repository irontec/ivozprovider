<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;

/**
* TpTimingDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpTimingDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string|null
     */
    private $tag = null;

    /**
     * @var string|null
     */
    private $years = null;

    /**
     * @var string|null
     */
    private $months = null;

    /**
     * @var string|null
     */
    private $monthDays = null;

    /**
     * @var string|null
     */
    private $weekDays = null;

    /**
     * @var string|null
     */
    private $time = '00:00:00';

    /**
     * @var \DateTimeInterface|string|null
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var RatingPlanDto | null
     */
    private $ratingPlan = null;

    /**
     * @param string|int|null $id
     */
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
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

    public function setTpid(string $tpid): static
    {
        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setYears(string $years): static
    {
        $this->years = $years;

        return $this;
    }

    public function getYears(): ?string
    {
        return $this->years;
    }

    public function setMonths(string $months): static
    {
        $this->months = $months;

        return $this;
    }

    public function getMonths(): ?string
    {
        return $this->months;
    }

    public function setMonthDays(string $monthDays): static
    {
        $this->monthDays = $monthDays;

        return $this;
    }

    public function getMonthDays(): ?string
    {
        return $this->monthDays;
    }

    public function setWeekDays(string $weekDays): static
    {
        $this->weekDays = $weekDays;

        return $this;
    }

    public function getWeekDays(): ?string
    {
        return $this->weekDays;
    }

    public function setTime(string $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setCreatedAt(\DateTimeInterface|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface|string|null
    {
        return $this->createdAt;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setRatingPlan(?RatingPlanDto $ratingPlan): static
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    public function getRatingPlan(): ?RatingPlanDto
    {
        return $this->ratingPlan;
    }

    public function setRatingPlanId($id): static
    {
        $value = !is_null($id)
            ? new RatingPlanDto($id)
            : null;

        return $this->setRatingPlan($value);
    }

    public function getRatingPlanId()
    {
        if ($dto = $this->getRatingPlan()) {
            return $dto->getId();
        }

        return null;
    }
}
