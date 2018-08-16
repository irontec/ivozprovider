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
     * @deprecated
     * Set setid
     *
     * @param integer $setid
     *
     * @return self
     */
    public function setSetid($setid);

    /**
     * Get setid
     *
     * @return integer
     */
    public function getSetid();

    /**
     * @deprecated
     * Set destination
     *
     * @param string $destination
     *
     * @return self
     */
    public function setDestination($destination);

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination();

    /**
     * @deprecated
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags);

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * @deprecated
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * @deprecated
     * Set attrs
     *
     * @param string $attrs
     *
     * @return self
     */
    public function setAttrs($attrs);

    /**
     * Get attrs
     *
     * @return string
     */
    public function getAttrs();

    /**
     * @deprecated
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

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

