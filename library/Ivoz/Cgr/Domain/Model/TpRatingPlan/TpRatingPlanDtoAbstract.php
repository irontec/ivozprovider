<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;

/**
* TpRatingPlanDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpRatingPlanDtoAbstract implements DataTransferObjectInterface
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
     * @var string | null
     */
    private $destratesTag;

    /**
     * @var string
     */
    private $timingTag = '*any';

    /**
     * @var float
     */
    private $weight = 10;

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
            'destratesTag' => 'destratesTag',
            'timingTag' => 'timingTag',
            'weight' => 'weight',
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
            'destratesTag' => $this->getDestratesTag(),
            'timingTag' => $this->getTimingTag(),
            'weight' => $this->getWeight(),
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
     * @param string $destratesTag | null
     *
     * @return static
     */
    public function setDestratesTag(?string $destratesTag = null): self
    {
        $this->destratesTag = $destratesTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestratesTag(): ?string
    {
        return $this->destratesTag;
    }

    /**
     * @param string $timingTag | null
     *
     * @return static
     */
    public function setTimingTag(?string $timingTag = null): self
    {
        $this->timingTag = $timingTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTimingTag(): ?string
    {
        return $this->timingTag;
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
