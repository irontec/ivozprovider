<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CompanyServiceInterface
*/
interface CompanyServiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): CompanyServiceInterface;

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): CompanyServiceInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get service
     *
     * @return ServiceInterface
     */
    public function getService(): ServiceInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
