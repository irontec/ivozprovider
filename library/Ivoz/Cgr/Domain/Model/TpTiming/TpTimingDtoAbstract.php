<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;

/**
* TpTimingDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpTimingDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string | null
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
     * @var \DateTimeInterface
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var RatingPlanDto | null
     */
    private $ratingPlan;

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

    /**
     * @param string $tpid | null
     *
     * @return static
     */
    public function setTpid(?string $tpid = null): self
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    /**
     * @param string $tag | null
     *
     * @return static
     */
    public function setTag(?string $tag = null): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string $years | null
     *
     * @return static
     */
    public function setYears(?string $years = null): self
    {
        $this->years = $years;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getYears(): ?string
    {
        return $this->years;
    }

    /**
     * @param string $months | null
     *
     * @return static
     */
    public function setMonths(?string $months = null): self
    {
        $this->months = $months;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMonths(): ?string
    {
        return $this->months;
    }

    /**
     * @param string $monthDays | null
     *
     * @return static
     */
    public function setMonthDays(?string $monthDays = null): self
    {
        $this->monthDays = $monthDays;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMonthDays(): ?string
    {
        return $this->monthDays;
    }

    /**
     * @param string $weekDays | null
     *
     * @return static
     */
    public function setWeekDays(?string $weekDays = null): self
    {
        $this->weekDays = $weekDays;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getWeekDays(): ?string
    {
        return $this->weekDays;
    }

    /**
     * @param string $time | null
     *
     * @return static
     */
    public function setTime(?string $time = null): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * @param \DateTimeInterface $createdAt | null
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @param RatingPlanDto | null
     *
     * @return static
     */
    public function setRatingPlan(?RatingPlanDto $ratingPlan = null): self
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * @return RatingPlanDto | null
     */
    public function getRatingPlan(): ?RatingPlanDto
    {
        return $this->ratingPlan;
    }

    /**
     * @return static
     */
    public function setRatingPlanId($id): self
    {
        $value = !is_null($id)
            ? new RatingPlanDto($id)
            : null;

        return $this->setRatingPlan($value);
    }

    /**
     * @return mixed | null
     */
    public function getRatingPlanId()
    {
        if ($dto = $this->getRatingPlan()) {
            return $dto->getId();
        }

        return null;
    }

}
