<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TrunksCdrInterface extends EntityInterface
{
    const DIRECTION_INBOUND = 'inbound';
    const DIRECTION_OUTBOUND = 'outbound';


    public function isOutboundCall();

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
     * Get diversion
     *
     * @return string | null
     */
    public function getDiversion();

    /**
     * Get bounced
     *
     * @return boolean | null
     */
    public function getBounced();

    /**
     * Get parsed
     *
     * @return boolean | null
     */
    public function getParsed();

    /**
     * Get parserScheduledAt
     *
     * @return \DateTime
     */
    public function getParserScheduledAt(): \DateTime;

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection();

    /**
     * Get cgrid
     *
     * @return string | null
     */
    public function getCgrid();

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
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount();

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice();

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
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    public function getFax();

    /**
     * Get ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi();

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
