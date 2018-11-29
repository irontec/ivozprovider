<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface DispatcherInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get setid
     *
     * @return integer
     */
    public function getSetid();

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination();

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Get attrs
     *
     * @return string
     */
    public function getAttrs();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set applicationServer
     *
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer
     *
     * @return self
     */
    public function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer);

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    public function getApplicationServer();
}
