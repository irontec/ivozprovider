<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface QueueInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get periodicAnnounce
     *
     * @return string
     */
    public function getPeriodicAnnounce();

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer
     */
    public function getPeriodicAnnounceFrequency();

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout();

    /**
     * Get autopause
     *
     * @return string
     */
    public function getAutopause();

    /**
     * Get ringinuse
     *
     * @return string
     */
    public function getRinginuse();

    /**
     * Get wrapuptime
     *
     * @return integer
     */
    public function getWrapuptime();

    /**
     * Get maxlen
     *
     * @return integer
     */
    public function getMaxlen();

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy();

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight();

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue
     *
     * @return self
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue);

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue();
}
