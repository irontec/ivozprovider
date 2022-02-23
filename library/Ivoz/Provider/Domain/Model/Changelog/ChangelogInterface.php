<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Model\LoggerEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface ChangelogInterface extends LoggerEntityInterface, EntityInterface
{
    /**
     * @param \Ivoz\Core\Domain\Event\EntityEventInterface $event
     * @return self
     */
    public static function fromEvent(\Ivoz\Core\Domain\Event\EntityEventInterface $event, \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command);

    /**
     * @param array $data | null
     * @return static
     */
    public function replaceData($data = null);

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
    public function getData();

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
     * Get command
     *
     * @return \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface
     */
    public function getCommand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
