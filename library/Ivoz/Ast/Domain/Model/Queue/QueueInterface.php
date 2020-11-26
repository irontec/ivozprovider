<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* QueueInterface
*/
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
    public function getName(): string;

    /**
     * Get periodicAnnounce
     *
     * @return string | null
     */
    public function getPeriodicAnnounce(): ?string;

    /**
     * Get periodicAnnounceFrequency
     *
     * @return int | null
     */
    public function getPeriodicAnnounceFrequency(): ?int;

    /**
     * Get timeout
     *
     * @return int | null
     */
    public function getTimeout(): ?int;

    /**
     * Get autopause
     *
     * @return string
     */
    public function getAutopause(): string;

    /**
     * Get ringinuse
     *
     * @return string
     */
    public function getRinginuse(): string;

    /**
     * Get wrapuptime
     *
     * @return int | null
     */
    public function getWrapuptime(): ?int;

    /**
     * Get maxlen
     *
     * @return int | null
     */
    public function getMaxlen(): ?int;

    /**
     * Get strategy
     *
     * @return string | null
     */
    public function getStrategy(): ?string;

    /**
     * Get weight
     *
     * @return int | null
     */
    public function getWeight(): ?int;

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue(): \Ivoz\Provider\Domain\Model\Queue\QueueInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
