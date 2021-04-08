<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

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

    public function getStartTime(): \DateTime;

    public function getEndTime(): \DateTime;

    public function getDuration(): float;

    public function getDirection(): ?string;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getDiversion(): ?string;

    public function getReferee(): ?string;

    public function getReferrer(): ?string;

    public function getCallid(): ?string;

    public function getCallidHash(): ?string;

    public function getXcallid(): ?string;

    public function getHidden(): bool;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getUser(): ?UserInterface;

    public function getFriend(): ?FriendInterface;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getRetailAccount(): ?RetailAccountInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
