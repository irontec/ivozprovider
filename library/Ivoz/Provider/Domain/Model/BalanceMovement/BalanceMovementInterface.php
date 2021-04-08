<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

/**
* BalanceMovementInterface
*/
interface BalanceMovementInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getAmount(): ?float;

    public function getBalance(): ?float;

    public function getCreatedOn(): ?\DateTime;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
