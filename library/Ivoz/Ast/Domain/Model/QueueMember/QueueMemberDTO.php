<?php

namespace Ivoz\Ast\Domain\Model\QueueMember;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class QueueMemberDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $queueName;

    /**
     * @var string
     */
    private $interface;

    /**
     * @var string
     */
    private $membername;

    /**
     * @var string
     */
    private $stateInterface;

    /**
     * @var integer
     */
    private $penalty;

    /**
     * @var integer
     */
    private $paused;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $queueMemberId;

    /**
     * @var mixed
     */
    private $queueMember;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'queueName' => $this->getQueueName(),
            'interface' => $this->getInterface(),
            'membername' => $this->getMembername(),
            'stateInterface' => $this->getStateInterface(),
            'penalty' => $this->getPenalty(),
            'paused' => $this->getPaused(),
            'id' => $this->getId(),
            'queueMemberId' => $this->getQueueMemberId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->queueMember = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\QueueMember\\QueueMember', $this->getQueueMemberId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $queueName
     *
     * @return QueueMemberDTO
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @param string $interface
     *
     * @return QueueMemberDTO
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;

        return $this;
    }

    /**
     * @return string
     */
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * @param string $membername
     *
     * @return QueueMemberDTO
     */
    public function setMembername($membername = null)
    {
        $this->membername = $membername;

        return $this;
    }

    /**
     * @return string
     */
    public function getMembername()
    {
        return $this->membername;
    }

    /**
     * @param string $stateInterface
     *
     * @return QueueMemberDTO
     */
    public function setStateInterface($stateInterface = null)
    {
        $this->stateInterface = $stateInterface;

        return $this;
    }

    /**
     * @return string
     */
    public function getStateInterface()
    {
        return $this->stateInterface;
    }

    /**
     * @param integer $penalty
     *
     * @return QueueMemberDTO
     */
    public function setPenalty($penalty = null)
    {
        $this->penalty = $penalty;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * @param integer $paused
     *
     * @return QueueMemberDTO
     */
    public function setPaused($paused = null)
    {
        $this->paused = $paused;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPaused()
    {
        return $this->paused;
    }

    /**
     * @param integer $id
     *
     * @return QueueMemberDTO
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
     * @param integer $queueMemberId
     *
     * @return QueueMemberDTO
     */
    public function setQueueMemberId($queueMemberId)
    {
        $this->queueMemberId = $queueMemberId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQueueMemberId()
    {
        return $this->queueMemberId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\QueueMember\QueueMember
     */
    public function getQueueMember()
    {
        return $this->queueMember;
    }
}

