<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpRatingPlanDTO implements DataTransferObjectInterface
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
    private $timingTag;

    /**
     * @var string
     */
    private $weight = 10;

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $timingId;

    /**
     * @var mixed
     */
    private $ratingPlanId;

    /**
     * @var mixed
     */
    private $destinationRateId;

    /**
     * @var mixed
     */
    private $timing;

    /**
     * @var mixed
     */
    private $ratingPlan;

    /**
     * @var mixed
     */
    private $destinationRate;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'destratesTag' => $this->getDestratesTag(),
            'timingTag' => $this->getTimingTag(),
            'weight' => $this->getWeight(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'timingId' => $this->getTimingId(),
            'ratingPlanId' => $this->getRatingPlanId(),
            'destinationRateId' => $this->getDestinationRateId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->timing = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\TpTiming\\TpTiming', $this->getTimingId());
        $this->ratingPlan = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\RatingPlan\\RatingPlan', $this->getRatingPlanId());
        $this->destinationRate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\DestinationRate\\DestinationRate', $this->getDestinationRateId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return TpRatingPlanDTO
     */
    public function setTpid($tpid)
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
     * @return TpRatingPlanDTO
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
     * @param string $destratesTag
     *
     * @return TpRatingPlanDTO
     */
    public function setDestratesTag($destratesTag = null)
    {
        $this->destratesTag = $destratesTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestratesTag()
    {
        return $this->destratesTag;
    }

    /**
     * @param string $timingTag
     *
     * @return TpRatingPlanDTO
     */
    public function setTimingTag($timingTag = null)
    {
        $this->timingTag = $timingTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimingTag()
    {
        return $this->timingTag;
    }

    /**
     * @param string $weight
     *
     * @return TpRatingPlanDTO
     */
    public function setWeight($weight)
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
     * @param \DateTime $createdAt
     *
     * @return TpRatingPlanDTO
     */
    public function setCreatedAt($createdAt)
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
     * @return TpRatingPlanDTO
     */
    public function setId($id)
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
     * @param integer $timingId
     *
     * @return TpRatingPlanDTO
     */
    public function setTimingId($timingId)
    {
        $this->timingId = $timingId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimingId()
    {
        return $this->timingId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpTiming\TpTiming
     */
    public function getTiming()
    {
        return $this->timing;
    }

    /**
     * @param integer $ratingPlanId
     *
     * @return TpRatingPlanDTO
     */
    public function setRatingPlanId($ratingPlanId)
    {
        $this->ratingPlanId = $ratingPlanId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRatingPlanId()
    {
        return $this->ratingPlanId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlan
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }

    /**
     * @param integer $destinationRateId
     *
     * @return TpRatingPlanDTO
     */
    public function setDestinationRateId($destinationRateId)
    {
        $this->destinationRateId = $destinationRateId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDestinationRateId()
    {
        return $this->destinationRateId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRate
     */
    public function getDestinationRate()
    {
        return $this->destinationRate;
    }
}


