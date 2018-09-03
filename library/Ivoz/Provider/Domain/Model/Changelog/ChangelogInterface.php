<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Model\EntityInterface;

interface ChangelogInterface extends EntityInterface
{
    /**
     * @param EntityEventInterface $event
     * @return Changelog
     */
    public static function fromEvent(\Ivoz\Core\Domain\Event\EntityEventInterface $event);

    /**
     * @deprecated
     * Set entity
     *
     * @param string $entity
     *
     * @return self
     */
    public function setEntity($entity);

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity();

    /**
     * @deprecated
     * Set entityId
     *
     * @param string $entityId
     *
     * @return self
     */
    public function setEntityId($entityId);

    /**
     * Get entityId
     *
     * @return string
     */
    public function getEntityId();

    /**
     * @deprecated
     * Set data
     *
     * @param array $data
     *
     * @return self
     */
    public function setData($data = null);

    /**
     * Get data
     *
     * @return array
     */
    public function getData();

    /**
     * @deprecated
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    public function setCreatedOn($createdOn);

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn();

    /**
     * @deprecated
     * Set microtime
     *
     * @param integer $microtime
     *
     * @return self
     */
    public function setMicrotime($microtime);

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
