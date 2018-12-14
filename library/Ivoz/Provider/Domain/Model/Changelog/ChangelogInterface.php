<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Model\LoggerEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface ChangelogInterface extends LoggerEntityInterface, EntityInterface
{
    /**
     * @param EntityEventInterface $event
     * @return Changelog
     */
    public static function fromEvent(\Ivoz\Core\Domain\Event\EntityEventInterface $event);

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity();

    /**
     * Get entityId
     *
     * @return string
     */
    public function getEntityId();

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
    public function getCreatedOn();

    /**
     * Get microtime
     *
     * @return integer
     */
    public function getMicrotime();

    /**
     * Set command
     *
     * @param \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command
     *
     * @return self
     */
    public function setCommand(\Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface $command);

    /**
     * Get command
     *
     * @return \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface
     */
    public function getCommand();
}
