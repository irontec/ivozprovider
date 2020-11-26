<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersCdrInterface
*/
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
     * @return \DateTimeInterface
     */
    public function getStartTime(): \DateTimeInterface;

    /**
     * Get endTime
     *
     * @return \DateTimeInterface
     */
    public function getEndTime(): \DateTimeInterface;

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
    public function getDirection(): ?string;

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller(): ?string;

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee(): ?string;

    /**
     * Get diversion
     *
     * @return string | null
     */
    public function getDiversion(): ?string;

    /**
     * Get referee
     *
     * @return string | null
     */
    public function getReferee(): ?string;

    /**
     * Get referrer
     *
     * @return string | null
     */
    public function getReferrer(): ?string;

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid(): ?string;

    /**
     * Get callidHash
     *
     * @return string | null
     */
    public function getCallidHash(): ?string;

    /**
     * Get xcallid
     *
     * @return string | null
     */
    public function getXcallid(): ?string;

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * Get friend
     *
     * @return FriendInterface | null
     */
    public function getFriend(): ?FriendInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
