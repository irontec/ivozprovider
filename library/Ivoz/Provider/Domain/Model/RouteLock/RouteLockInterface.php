<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* RouteLockInterface
*/
interface RouteLockInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Return in current lock status is open
     *
     * @return boolean
     */
    public function isOpen();

    public function getName(): string;

    public function getDescription(): string;

    public function getOpen(): bool;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
