<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class CallAclRelPatternDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $priority;

    /**
     * @var string
     */
    private $policy;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $callAclId;

    /**
     * @var mixed
     */
    private $callAclPatternId;

    /**
     * @var mixed
     */
    private $callAcl;

    /**
     * @var mixed
     */
    private $callAclPattern;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'priority' => $this->getPriority(),
            'policy' => $this->getPolicy(),
            'id' => $this->getId(),
            'callAclId' => $this->getCallAclId(),
            'callAclPatternId' => $this->getCallAclPatternId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->callAcl = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\CallAcl\\CallAcl', $this->getCallAclId());
        $this->callAclPattern = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\CallAclPattern\\CallAclPattern', $this->getCallAclPatternId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $priority
     *
     * @return CallAclRelPatternDTO
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
     * @param string $policy
     *
     * @return CallAclRelPatternDTO
     */
    public function setPolicy($policy)
    {
        $this->policy = $policy;

        return $this;
    }

    /**
     * @return string
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * @param integer $id
     *
     * @return CallAclRelPatternDTO
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
     * @param integer $callAclId
     *
     * @return CallAclRelPatternDTO
     */
    public function setCallAclId($callAclId)
    {
        $this->callAclId = $callAclId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCallAclId()
    {
        return $this->callAclId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAcl
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * @param integer $callAclPatternId
     *
     * @return CallAclRelPatternDTO
     */
    public function setCallAclPatternId($callAclPatternId)
    {
        $this->callAclPatternId = $callAclPatternId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCallAclPatternId()
    {
        return $this->callAclPatternId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPattern
     */
    public function getCallAclPattern()
    {
        return $this->callAclPattern;
    }
}


