<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
* TrunksCdrInterface
*/
interface TrunksCdrInterface extends EntityInterface
{
    const DIRECTION_INBOUND = 'inbound';

    const DIRECTION_OUTBOUND = 'outbound';

    public function isOutboundCall();

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
     * Get diversion
     *
     * @return string | null
     */
    public function getDiversion(): ?string;

    /**
     * Get bounced
     *
     * @return bool | null
     */
    public function getBounced(): ?bool;

    /**
     * Get parsed
     *
     * @return bool | null
     */
    public function getParsed(): ?bool;

    /**
     * Get parserScheduledAt
     *
     * @return \DateTimeInterface
     */
    public function getParserScheduledAt(): \DateTimeInterface;

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection(): ?string;

    /**
     * Get cgrid
     *
     * @return string | null
     */
    public function getCgrid(): ?string;

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
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface;

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

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
     * Get fax
     *
     * @return FaxInterface | null
     */
    public function getFax(): ?FaxInterface;

    /**
     * Get ddi
     *
     * @return DdiInterface | null
     */
    public function getDdi(): ?DdiInterface;

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
