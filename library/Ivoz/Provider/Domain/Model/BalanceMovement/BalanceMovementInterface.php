<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get amount
     *
     * @return float | null
     */
    public function getAmount(): ?float;

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance(): ?float;

    /**
     * Get createdOn
     *
     * @return \DateTimeInterface | null
     */
    public function getCreatedOn(): ?\DateTimeInterface;

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
     * @return bool
     */
    public function isInitialized(): bool;

}
