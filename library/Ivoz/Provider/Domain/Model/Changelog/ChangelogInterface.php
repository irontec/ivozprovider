<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Event\EntityEventInterface;
use Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* ChangelogInterface
*/
interface ChangelogInterface extends EntityInterface
{
    /**
     * @param \Ivoz\Core\Domain\Event\EntityEventInterface $event
     * @return self
     */
    public static function fromEvent(EntityEventInterface $event, CommandlogInterface $command);

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity(): string;

    /**
     * Get entityId
     *
     * @return string
     */
    public function getEntityId(): string;

    /**
     * Get data
     *
     * @return array | null
     */
    public function getData(): ?array;

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
     * Get command
     *
     * @return CommandlogInterface
     */
    public function getCommand(): CommandlogInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
