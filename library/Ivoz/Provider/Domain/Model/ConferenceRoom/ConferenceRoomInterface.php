<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ConferenceRoomInterface extends LoggableEntityInterface
{
    const ANNOUNCEUSERCOUNT_ALWAYS = 'always';
    const ANNOUNCEUSERCOUNT_FIRST = 'first';


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
     * @return boolean
     */
    public function getPinProtected(): bool;

    /**
     * Get pinCode
     *
     * @return string | null
     */
    public function getPinCode();

    /**
     * Get maxMembers
     *
     * @return integer
     */
    public function getMaxMembers(): int;

    /**
     * Get announceUserCount
     *
     * @return string
     */
    public function getAnnounceUserCount(): string;

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
