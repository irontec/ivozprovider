<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Event\CommandEventInterface;

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

    public function getRequestId(): string;

    public function getClass(): string;

    public function getMethod(): ?string;

    public function getArguments(): ?array;

    public function getAgent(): ?array;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): \DateTimeInterface;

    public function getMicrotime(): int;

    public function isInitialized(): bool;
}
