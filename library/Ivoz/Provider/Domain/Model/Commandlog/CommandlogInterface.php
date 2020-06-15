<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Domain\Model\LoggerEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface CommandlogInterface extends LoggerEntityInterface, EntityInterface
{
    /**
     * @param \Ivoz\Core\Application\Event\CommandEventInterface $event
     * @return self
     */
    public static function fromEvent(\Ivoz\Core\Application\Event\CommandEventInterface $event);

    /**
     * Get requestId
     *
     * @return string
     */
    public function getRequestId(): string;

    /**
     * Get class
     *
     * @return string
     */
    public function getClass(): string;

    /**
     * Get method
     *
     * @return string | null
     */
    public function getMethod();

    /**
     * Get arguments
     *
     * @return array | null
     */
    public function getArguments();

    /**
     * Get agent
     *
     * @return array | null
     */
    public function getAgent();

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn(): \DateTime;

    /**
     * Get microtime
     *
     * @return integer
     */
    public function getMicrotime(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
