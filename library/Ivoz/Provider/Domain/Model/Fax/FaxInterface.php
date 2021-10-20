<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* FaxInterface
*/
interface FaxInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function setSendByEmail(bool $sendByEmail): static;

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi(): DdiInterface;

    public function getName(): string;

    public function getEmail(): ?string;

    public function getSendByEmail(): bool;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
