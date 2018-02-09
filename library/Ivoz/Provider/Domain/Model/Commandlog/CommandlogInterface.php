<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Domain\Model\EntityInterface;

interface CommandlogInterface extends EntityInterface
{
    /**
     * @param CommandEventInterface $event
     * @return Commandlog
     */
    public static function fromEvent(\Ivoz\Core\Application\Event\CommandEventInterface $event);

    /**
     * Set requestId
     *
     * @param guid $requestId
     *
     * @return self
     */
    public function setRequestId($requestId);

    /**
     * Get requestId
     *
     * @return guid
     */
    public function getRequestId();

    /**
     * Set class
     *
     * @param string $class
     *
     * @return self
     */
    public function setClass($class);

    /**
     * Get class
     *
     * @return string
     */
    public function getClass();

    /**
     * Set method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod($method = null);

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod();

    /**
     * Set arguments
     *
     * @param array $arguments
     *
     * @return self
     */
    public function setArguments($arguments = null);

    /**
     * Get arguments
     *
     * @return array
     */
    public function getArguments();

    /**
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

}

