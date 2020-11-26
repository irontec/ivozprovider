<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Application\Event\CommandEventInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* CommandlogInterface
*/
interface CommandlogInterface extends EntityInterface
{
    /**
     * @param \Ivoz\Core\Application\Event\CommandEventInterface $event
     * @return self
     */
    public static function fromEvent(CommandEventInterface $event);

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
    public function getMethod(): ?string;

    /**
     * Get arguments
     *
     * @return array | null
     */
    public function getArguments(): ?array;

    /**
     * Get agent
     *
     * @return array | null
     */
    public function getAgent(): ?array;

    /**
     * Get createdOn
     *
     * @return \DateTimeInterface
     */
    public function getCreatedOn(): \DateTimeInterface;

    /**
     * Get microtime
     *
     * @return int
     */
    public function getMicrotime(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
