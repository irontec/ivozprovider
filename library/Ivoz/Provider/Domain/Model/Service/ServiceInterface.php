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
    public function setDefaultCode(string $defaultCode): static;

    public function getIden(): string;

    public function getDefaultCode(): string;

    public function getExtraArgs(): bool;

    public function getName(): Name;

    public function getDescription(): Description;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
