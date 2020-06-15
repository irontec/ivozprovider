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
    public function getIden(): string;

    /**
     * Get defaultCode
     *
     * @return string
     */
    public function getDefaultCode(): string;

    /**
     * Get extraArgs
     *
     * @return boolean
     */
    public function getExtraArgs(): bool;

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Service\Name
     */
    public function getName();

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\Service\Description
     */
    public function getDescription();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
