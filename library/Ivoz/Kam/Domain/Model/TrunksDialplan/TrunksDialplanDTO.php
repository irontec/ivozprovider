<?php

namespace Ivoz\Kam\Domain\Model\TrunksDialplan;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TrunksDialplanDTO implements DataTransferObjectInterface
{
    use TrunksDialplanDTOTrait;

    /**
     * @var integer
     */
    private $dpid;

    /**
     * @var integer
     */
    private $pr;

    /**
     * @var integer
     */
    private $matchOp;

    /**
     * @var string
     */
    private $matchExp;

    /**
     * @var integer
     */
    private $matchLen;

    /**
     * @var string
     */
    private $substExp;

    /**
     * @var string
     */
    private $replExp;

    /**
     * @var string
     */
    private $attrs;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $transformationRulesetGroupsTrunkId;

    /**
     * @var mixed
     */
    private $transformationRulesetGroupsTrunk;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'dpid' => $this->getDpid(),
            'pr' => $this->getPr(),
            'matchOp' => $this->getMatchOp(),
            'matchExp' => $this->getMatchExp(),
            'matchLen' => $this->getMatchLen(),
            'substExp' => $this->getSubstExp(),
            'replExp' => $this->getReplExp(),
            'attrs' => $this->getAttrs(),
            'id' => $this->getId(),
            'transformationRulesetGroupsTrunkId' => $this->getTransformationRulesetGroupsTrunkId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->transformationRulesetGroupsTrunk = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\TransformationRulesetGroupsTrunk\\TransformationRulesetGroupsTrunk', $this->getTransformationRulesetGroupsTrunkId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $dpid
     *
     * @return TrunksDialplanDTO
     */
    public function setDpid($dpid)
    {
        $this->dpid = $dpid;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDpid()
    {
        return $this->dpid;
    }

    /**
     * @param integer $pr
     *
     * @return TrunksDialplanDTO
     */
    public function setPr($pr)
    {
        $this->pr = $pr;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPr()
    {
        return $this->pr;
    }

    /**
     * @param integer $matchOp
     *
     * @return TrunksDialplanDTO
     */
    public function setMatchOp($matchOp)
    {
        $this->matchOp = $matchOp;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMatchOp()
    {
        return $this->matchOp;
    }

    /**
     * @param string $matchExp
     *
     * @return TrunksDialplanDTO
     */
    public function setMatchExp($matchExp)
    {
        $this->matchExp = $matchExp;

        return $this;
    }

    /**
     * @return string
     */
    public function getMatchExp()
    {
        return $this->matchExp;
    }

    /**
     * @param integer $matchLen
     *
     * @return TrunksDialplanDTO
     */
    public function setMatchLen($matchLen)
    {
        $this->matchLen = $matchLen;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMatchLen()
    {
        return $this->matchLen;
    }

    /**
     * @param string $substExp
     *
     * @return TrunksDialplanDTO
     */
    public function setSubstExp($substExp)
    {
        $this->substExp = $substExp;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubstExp()
    {
        return $this->substExp;
    }

    /**
     * @param string $replExp
     *
     * @return TrunksDialplanDTO
     */
    public function setReplExp($replExp)
    {
        $this->replExp = $replExp;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplExp()
    {
        return $this->replExp;
    }

    /**
     * @param string $attrs
     *
     * @return TrunksDialplanDTO
     */
    public function setAttrs($attrs)
    {
        $this->attrs = $attrs;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * @param integer $id
     *
     * @return TrunksDialplanDTO
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
     * @param integer $transformationRulesetGroupsTrunkId
     *
     * @return TrunksDialplanDTO
     */
    public function setTransformationRulesetGroupsTrunkId($transformationRulesetGroupsTrunkId)
    {
        $this->transformationRulesetGroupsTrunkId = $transformationRulesetGroupsTrunkId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTransformationRulesetGroupsTrunkId()
    {
        return $this->transformationRulesetGroupsTrunkId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunk
     */
    public function getTransformationRulesetGroupsTrunk()
    {
        return $this->transformationRulesetGroupsTrunk;
    }
}

