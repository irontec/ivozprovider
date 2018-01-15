<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpDestinationRateDTO implements DataTransferObjectInterface
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
    private $destinationsTag;

    /**
     * @var string
     */
    private $ratesTag;

    /**
     * @var string
     */
    private $roundingMethod = '*up';

    /**
     * @var integer
     */
    private $roundingDecimals = 4;

    /**
     * @var string
     */
    private $maxCost = '0.000';

    /**
     * @var string
     */
    private $maxCostStrategy = '';

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
    private $destinationRateId;

    /**
     * @var mixed
     */
    private $destinationId;

    /**
     * @var mixed
     */
    private $rateId;

    /**
     * @var mixed
     */
    private $destinationRate;

    /**
     * @var mixed
     */
    private $destination;

    /**
     * @var mixed
     */
    private $rate;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'destinationsTag' => $this->getDestinationsTag(),
            'ratesTag' => $this->getRatesTag(),
            'roundingMethod' => $this->getRoundingMethod(),
            'roundingDecimals' => $this->getRoundingDecimals(),
            'maxCost' => $this->getMaxCost(),
            'maxCostStrategy' => $this->getMaxCostStrategy(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'destinationRateId' => $this->getDestinationRateId(),
            'destinationId' => $this->getDestinationId(),
            'rateId' => $this->getRateId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->destinationRate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\DestinationRate\\DestinationRate', $this->getDestinationRateId());
        $this->destination = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\Destination\\Destination', $this->getDestinationId());
        $this->rate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\Rate\\Rate', $this->getRateId());
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
     * @return TpDestinationRateDTO
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
     * @return TpDestinationRateDTO
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
     * @param string $destinationsTag
     *
     * @return TpDestinationRateDTO
     */
    public function setDestinationsTag($destinationsTag = null)
    {
        $this->destinationsTag = $destinationsTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationsTag()
    {
        return $this->destinationsTag;
    }

    /**
     * @param string $ratesTag
     *
     * @return TpDestinationRateDTO
     */
    public function setRatesTag($ratesTag = null)
    {
        $this->ratesTag = $ratesTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getRatesTag()
    {
        return $this->ratesTag;
    }

    /**
     * @param string $roundingMethod
     *
     * @return TpDestinationRateDTO
     */
    public function setRoundingMethod($roundingMethod)
    {
        $this->roundingMethod = $roundingMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoundingMethod()
    {
        return $this->roundingMethod;
    }

    /**
     * @param integer $roundingDecimals
     *
     * @return TpDestinationRateDTO
     */
    public function setRoundingDecimals($roundingDecimals)
    {
        $this->roundingDecimals = $roundingDecimals;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRoundingDecimals()
    {
        return $this->roundingDecimals;
    }

    /**
     * @param string $maxCost
     *
     * @return TpDestinationRateDTO
     */
    public function setMaxCost($maxCost)
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * @return string
     */
    public function getMaxCost()
    {
        return $this->maxCost;
    }

    /**
     * @param string $maxCostStrategy
     *
     * @return TpDestinationRateDTO
     */
    public function setMaxCostStrategy($maxCostStrategy)
    {
        $this->maxCostStrategy = $maxCostStrategy;

        return $this;
    }

    /**
     * @return string
     */
    public function getMaxCostStrategy()
    {
        return $this->maxCostStrategy;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return TpDestinationRateDTO
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
     * @return TpDestinationRateDTO
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
     * @param integer $destinationRateId
     *
     * @return TpDestinationRateDTO
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

    /**
     * @param integer $destinationId
     *
     * @return TpDestinationRateDTO
     */
    public function setDestinationId($destinationId)
    {
        $this->destinationId = $destinationId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDestinationId()
    {
        return $this->destinationId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\Destination\Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param integer $rateId
     *
     * @return TpDestinationRateDTO
     */
    public function setRateId($rateId)
    {
        $this->rateId = $rateId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRateId()
    {
        return $this->rateId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\Rate\Rate
     */
    public function getRate()
    {
        return $this->rate;
    }
}


