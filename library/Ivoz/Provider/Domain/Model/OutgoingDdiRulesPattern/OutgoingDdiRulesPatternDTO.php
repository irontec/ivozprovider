<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class OutgoingDdiRulesPatternDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var integer
     */
    private $priority = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $outgoingDdiRuleId;

    /**
     * @var mixed
     */
    private $matchListId;

    /**
     * @var mixed
     */
    private $forcedDdiId;

    /**
     * @var mixed
     */
    private $outgoingDdiRule;

    /**
     * @var mixed
     */
    private $matchList;

    /**
     * @var mixed
     */
    private $forcedDdi;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'action' => $this->getAction(),
            'priority' => $this->getPriority(),
            'id' => $this->getId(),
            'outgoingDdiRuleId' => $this->getOutgoingDdiRuleId(),
            'matchListId' => $this->getMatchListId(),
            'forcedDdiId' => $this->getForcedDdiId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->outgoingDdiRule = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\OutgoingDdiRule\\OutgoingDdiRule', $this->getOutgoingDdiRuleId());
        $this->matchList = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\MatchList\\MatchList', $this->getMatchListId());
        $this->forcedDdi = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi', $this->getForcedDdiId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $action
     *
     * @return OutgoingDdiRulesPatternDTO
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param integer $priority
     *
     * @return OutgoingDdiRulesPatternDTO
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param integer $id
     *
     * @return OutgoingDdiRulesPatternDTO
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
     * @param integer $outgoingDdiRuleId
     *
     * @return OutgoingDdiRulesPatternDTO
     */
    public function setOutgoingDdiRuleId($outgoingDdiRuleId)
    {
        $this->outgoingDdiRuleId = $outgoingDdiRuleId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutgoingDdiRuleId()
    {
        return $this->outgoingDdiRuleId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param integer $matchListId
     *
     * @return OutgoingDdiRulesPatternDTO
     */
    public function setMatchListId($matchListId)
    {
        $this->matchListId = $matchListId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMatchListId()
    {
        return $this->matchListId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchList
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * @param integer $forcedDdiId
     *
     * @return OutgoingDdiRulesPatternDTO
     */
    public function setForcedDdiId($forcedDdiId)
    {
        $this->forcedDdiId = $forcedDdiId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getForcedDdiId()
    {
        return $this->forcedDdiId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\Ddi
     */
    public function getForcedDdi()
    {
        return $this->forcedDdi;
    }
}


