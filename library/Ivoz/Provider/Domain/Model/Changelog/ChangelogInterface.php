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
     * Get command
     *
     * @return \Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface
     */
    public function getCommand();
}
