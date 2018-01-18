<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpRateDTO implements DataTransferObjectInterface
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
    private $connectFee;

    /**
     * @var string
     */
    private $rateCost;

    /**
     * @var string
     */
    private $rateUnit = '60s';

    /**
     * @var string
     */
    private $rateIncrement;

    /**
     * @var string
     */
    private $groupIntervalStart = '0s';

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
    private $rateId;

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
            'connectFee' => $this->getConnectFee(),
            'rateCost' => $this->getRateCost(),
            'rateUnit' => $this->getRateUnit(),
            'rateIncrement' => $this->getRateIncrement(),
            'groupIntervalStart' => $this->getGroupIntervalStart(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'rateId' => $this->getRateId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
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
     * @return TpRateDTO
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
     * @return TpRateDTO
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
     * @param string $connectFee
     *
     * @return TpRateDTO
     */
    public function setConnectFee($connectFee)
    {
        $this->connectFee = $connectFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getConnectFee()
    {
        return $this->connectFee;
    }

    /**
     * @param string $rateCost
     *
     * @return TpRateDTO
     */
    public function setRateCost($rateCost)
    {
        $this->rateCost = $rateCost;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateCost()
    {
        return $this->rateCost;
    }

    /**
     * @param string $rateUnit
     *
     * @return TpRateDTO
     */
    public function setRateUnit($rateUnit)
    {
        $this->rateUnit = $rateUnit;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateUnit()
    {
        return $this->rateUnit;
    }

    /**
     * @param string $rateIncrement
     *
     * @return TpRateDTO
     */
    public function setRateIncrement($rateIncrement)
    {
        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateIncrement()
    {
        return $this->rateIncrement;
    }

    /**
     * @param string $groupIntervalStart
     *
     * @return TpRateDTO
     */
    public function setGroupIntervalStart($groupIntervalStart)
    {
        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    /**
     * @return string
     */
    public function getGroupIntervalStart()
    {
        return $this->groupIntervalStart;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return TpRateDTO
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
     * @return TpRateDTO
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
     * @param integer $rateId
     *
     * @return TpRateDTO
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


