<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getName();

    /**
     * Get pinProtected
     *
     * @return boolean
     */
    public function getPinProtected();

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
    public function getMaxMembers();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();
}
