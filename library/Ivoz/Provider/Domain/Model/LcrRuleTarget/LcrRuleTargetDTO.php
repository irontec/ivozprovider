<?php

namespace Ivoz\Provider\Domain\Model\LcrRuleTarget;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class LcrRuleTargetDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $lcrId = '1';

    /**
     * @var boolean
     */
    private $priority;

    /**
     * @var integer
     */
    private $weight = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $ruleId;

    /**
     * @var mixed
     */
    private $gwId;

    /**
     * @var mixed
     */
    private $outgoingRoutingId;

    /**
     * @var mixed
     */
    private $rule;

    /**
     * @var mixed
     */
    private $gw;

    /**
     * @var mixed
     */
    private $outgoingRouting;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'lcrId' => $this->getLcrId(),
            'priority' => $this->getPriority(),
            'weight' => $this->getWeight(),
            'id' => $this->getId(),
            'ruleId' => $this->getRuleId(),
            'gwId' => $this->getGwId(),
            'outgoingRoutingId' => $this->getOutgoingRoutingId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->rule = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\LcrRule\\LcrRule', $this->getRuleId());
        $this->gw = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\LcrGateway\\LcrGateway', $this->getGwId());
        $this->outgoingRouting = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\OutgoingRouting\\OutgoingRouting', $this->getOutgoingRoutingId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $lcrId
     *
     * @return LcrRuleTargetDTO
     */
    public function setLcrId($lcrId)
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
    }

    /**
     * @param boolean $priority
     *
     * @return LcrRuleTargetDTO
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param integer $weight
     *
     * @return LcrRuleTargetDTO
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param integer $id
     *
     * @return LcrRuleTargetDTO
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
     * @param integer $ruleId
     *
     * @return LcrRuleTargetDTO
     */
    public function setRuleId($ruleId)
    {
        $this->ruleId = $ruleId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRuleId()
    {
        return $this->ruleId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\LcrRule\LcrRule
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param integer $gwId
     *
     * @return LcrRuleTargetDTO
     */
    public function setGwId($gwId)
    {
        $this->gwId = $gwId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getGwId()
    {
        return $this->gwId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\LcrGateway\LcrGateway
     */
    public function getGw()
    {
        return $this->gw;
    }

    /**
     * @param integer $outgoingRoutingId
     *
     * @return LcrRuleTargetDTO
     */
    public function setOutgoingRoutingId($outgoingRoutingId)
    {
        $this->outgoingRoutingId = $outgoingRoutingId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutgoingRoutingId()
    {
        return $this->outgoingRoutingId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }
}


