<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface BalanceNotificationRepository extends ObjectRepository, Selectable
{
    /**
     * @param CompanyInterface $company
     * @param $prevValue
     * @param $currentValue
     * @return BalanceNotificationInterface[]
     */
    public function findBrokenThresholdsByCompany(CompanyInterface $company, $prevValue, $currentValue);

    /**
     * @param CarrierInterface $carrier
     * @param $prevValue
     * @param $currentValue
     * @return BalanceNotificationInterface[]
     */
    public function findBrokenThresholdsByCarrier(CarrierInterface $carrier, $prevValue, $currentValue);
}

