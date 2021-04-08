<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Core\Domain\Model\EntityInterface;
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

/**
* TrunksCdrInterface
*/
interface TrunksCdrInterface extends EntityInterface
{
    const DIRECTION_INBOUND = 'inbound';

    const DIRECTION_OUTBOUND = 'outbound';

    public function isOutboundCall();

    public function getStartTime(): \DateTime;

    public function getEndTime(): \DateTime;

    public function getDuration(): float;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getCallid(): ?string;

    public function getCallidHash(): ?string;

    public function getXcallid(): ?string;

    public function getDiversion(): ?string;

    public function getBounced(): ?bool;

    public function getParsed(): ?bool;

    public function getParserScheduledAt(): \DateTime;

    public function getDirection(): ?string;

    public function getCgrid(): ?string;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getRetailAccount(): ?RetailAccountInterface;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getUser(): ?UserInterface;

    public function getFriend(): ?FriendInterface;

    public function getFax(): ?FaxInterface;

    public function getDdi(): ?DdiInterface;

    public function getDdiProvider(): ?DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
