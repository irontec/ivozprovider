<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get open
     *
     * @return boolean
     */
    public function getOpen();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();
}
