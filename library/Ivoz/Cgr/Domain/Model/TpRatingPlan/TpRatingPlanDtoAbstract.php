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
     * @var string|null
     */
    private $tag;

    /**
     * @var string|null
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
     * @var \DateTimeInterface|string
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

    public function setDestratesTag(?string $destratesTag): static
    {
        $this->destratesTag = $destratesTag;

        return $this;
    }

    public function getDestratesTag(): ?string
    {
        return $this->destratesTag;
    }

    public function setTimingTag(string $timingTag): static
    {
        $this->timingTag = $timingTag;

        return $this;
    }

    public function getTimingTag(): ?string
    {
        return $this->timingTag;
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

    public function getId()
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
