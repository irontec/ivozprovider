<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

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

    public function getName(): string;

    public function getPinProtected(): bool;

    public function getPinCode(): ?string;

    public function getMaxMembers(): int;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
