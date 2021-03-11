<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface BalanceNotificationRepository extends ObjectRepository, Selectable
{
    /**
     * @param CompanyInterface $company
     * @param float $prevValue
     * @param float $currentValue
     * @return BalanceNotificationInterface[]
     */
    public function findBrokenThresholdsByCompany(CompanyInterface $company, $prevValue, $currentValue);

    /**
     * @param CarrierInterface $carrier
     * @param float $prevValue
     * @param float $currentValue
     * @return BalanceNotificationInterface[]
     */
    public function findBrokenThresholdsByCarrier(CarrierInterface $carrier, $prevValue, $currentValue);
}
