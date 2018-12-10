<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ServiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setDefaultCode($defaultCode);

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Get defaultCode
     *
     * @return string
     */
    public function getDefaultCode();

    /**
     * Get extraArgs
     *
     * @return boolean
     */
    public function getExtraArgs();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Service\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\Service\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Service\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Provider\Domain\Model\Service\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\Service\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\Service\Description
     */
    public function getDescription();
}
