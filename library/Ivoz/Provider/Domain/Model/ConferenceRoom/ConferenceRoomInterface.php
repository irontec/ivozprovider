<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ConferenceRoomInterface
*/
interface ConferenceRoomInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get pinProtected
     *
     * @return bool
     */
    public function getPinProtected(): bool;

    /**
     * Get pinCode
     *
     * @return string | null
     */
    public function getPinCode(): ?string;

    /**
     * Get maxMembers
     *
     * @return int
     */
    public function getMaxMembers(): int;

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
