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
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set periodicAnnounce
     *
     * @param string $periodicAnnounce
     *
     * @return self
     */
    public function setPeriodicAnnounce($periodicAnnounce = null);

    /**
     * Get periodicAnnounce
     *
     * @return string
     */
    public function getPeriodicAnnounce();

    /**
     * Set periodicAnnounceFrequency
     *
     * @param integer $periodicAnnounceFrequency
     *
     * @return self
     */
    public function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null);

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer
     */
    public function getPeriodicAnnounceFrequency();

    /**
     * Set timeout
     *
     * @param integer $timeout
     *
     * @return self
     */
    public function setTimeout($timeout = null);

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout();

    /**
     * Set autopause
     *
     * @param string $autopause
     *
     * @return self
     */
    public function setAutopause($autopause);

    /**
     * Get autopause
     *
     * @return string
     */
    public function getAutopause();

    /**
     * Set ringinuse
     *
     * @param string $ringinuse
     *
     * @return self
     */
    public function setRinginuse($ringinuse);

    /**
     * Get ringinuse
     *
     * @return string
     */
    public function getRinginuse();

    /**
     * Set wrapuptime
     *
     * @param integer $wrapuptime
     *
     * @return self
     */
    public function setWrapuptime($wrapuptime = null);

    /**
     * Get wrapuptime
     *
     * @return integer
     */
    public function getWrapuptime();

    /**
     * Set maxlen
     *
     * @param integer $maxlen
     *
     * @return self
     */
    public function setMaxlen($maxlen = null);

    /**
     * Get maxlen
     *
     * @return integer
     */
    public function getMaxlen();

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    public function setStrategy($strategy = null);

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy();

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight = null);

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

