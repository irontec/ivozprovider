<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* FaxInterface
*/
interface FaxInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setSendByEmail(bool $sendByEmail): FaxInterface;

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi(): DdiInterface;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get email
     *
     * @return string | null
     */
    public function getEmail(): ?string;

    /**
     * Get sendByEmail
     *
     * @return bool
     */
    public function getSendByEmail(): bool;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
