<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersCdrInterface extends EntityInterface
{
    /**
     * @return string
     */
    public function getOwner();

    /**
     * @return string
     */
    public function getParty();

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime(): \DateTime;

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime(): \DateTime;

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration(): float;

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection();

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller();

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee();

    /**
     * Get diversion
     *
     * @return string | null
     */
    public function getDiversion();

    /**
     * Get referee
     *
     * @return string | null
     */
    public function getReferee();

    /**
     * Get referrer
     *
     * @return string | null
     */
    public function getReferrer();

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid();

    /**
     * Get callidHash
     *
     * @return string | null
     */
    public function getCallidHash();

    /**
     * Get xcallid
     *
     * @return string | null
     */
    public function getXcallid();

    /**
     * Get hidden
     *
     * @return boolean
     */
    public function getHidden(): bool;

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser();

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface | null
     */
    public function getFriend();

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice();

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
