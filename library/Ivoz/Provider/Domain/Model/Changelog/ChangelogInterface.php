<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Event\EntityEventInterface;
use Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface;

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

    public function getEntity(): string;

    public function getEntityId(): string;

    public function getData(): ?array;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): \DateTimeInterface;

    public function getMicrotime(): int;

    public function getCommand(): CommandlogInterface;

    public function isInitialized(): bool;
}
