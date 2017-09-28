<?php

namespace Ivoz\Ast\Domain\Model\QueueMember;

use Ivoz\Core\Domain\Model\EntityInterface;

interface QueueMemberInterface extends EntityInterface
{
    /**
     * Set queueName
     *
     * @param string $queueName
     *
     * @return self
     */
    public function setQueueName($queueName);

    /**
     * Get queueName
     *
     * @return string
     */
    public function getQueueName();

    /**
     * Set interface
     *
     * @param string $interface
     *
     * @return self
     */
    public function setInterface($interface);

    /**
     * Get interface
     *
     * @return string
     */
    public function getInterface();

    /**
     * Set membername
     *
     * @param string $membername
     *
     * @return self
     */
    public function setMembername($membername = null);

    /**
     * Get membername
     *
     * @return string
     */
    public function getMembername();

    /**
     * Set stateInterface
     *
     * @param string $stateInterface
     *
     * @return self
     */
    public function setStateInterface($stateInterface = null);

    /**
     * Get stateInterface
     *
     * @return string
     */
    public function getStateInterface();

    /**
     * Set penalty
     *
     * @param integer $penalty
     *
     * @return self
     */
    public function setPenalty($penalty = null);

    /**
     * Get penalty
     *
     * @return integer
     */
    public function getPenalty();

    /**
     * Set paused
     *
     * @param integer $paused
     *
     * @return self
     */
    public function setPaused($paused = null);

    /**
     * Get paused
     *
     * @return integer
     */
    public function getPaused();

    /**
     * Set queueMember
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember
     *
     * @return self
     */
    public function setQueueMember(\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember = null);

    /**
     * Get queueMember
     *
     * @return \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface
     */
    public function getQueueMember();

}

