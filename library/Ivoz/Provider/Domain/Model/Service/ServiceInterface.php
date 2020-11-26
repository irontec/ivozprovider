<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ServiceInterface
*/
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
    public function setDefaultCode(string $defaultCode): ServiceInterface;

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
     * @return bool
     */
    public function getExtraArgs(): bool;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
