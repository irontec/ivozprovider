<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* TrustedInterface
*/
interface TrustedInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setSrcIp(?string $srcIp = null): static;

    public function getSrcIp(): ?string;

    public function getProto(): ?string;

    public function getFromPattern(): ?string;

    public function getRuriPattern(): ?string;

    public function getTag(): ?string;

    public function getDescription(): ?string;

    public function getPriority(): int;

    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
