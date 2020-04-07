<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpRatingPlanDtoAbstract implements DataTransferObjectInterface
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
     * @var \DateTime | string
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
     * @return string | null
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
     * @return string | null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $destratesTag
     *
     * @return static
     */
    public function setDestratesTag($destratesTag = null)
    {
        $this->destratesTag = $destratesTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestratesTag()
    {
        return $this->destratesTag;
    }

    /**
     * @param string $timingTag
     *
     * @return static
     */
    public function setTimingTag($timingTag = null)
    {
        $this->timingTag = $timingTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTimingTag()
    {
        return $this->timingTag;
    }

    /**
     * @param float $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getWeight()
    {
        return $this->weight;
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
     * @return \DateTime | null
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto | null
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }

    /**
     * @param mixed | null $id
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
