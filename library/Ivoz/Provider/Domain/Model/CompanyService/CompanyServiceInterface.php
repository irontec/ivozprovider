<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;

/**
* CompanyServiceInterface
*/
interface CompanyServiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): static;

    public function getCode(): string;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getService(): ServiceInterface;

    public function isInitialized(): bool;
}
