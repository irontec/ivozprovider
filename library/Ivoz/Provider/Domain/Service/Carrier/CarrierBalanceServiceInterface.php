<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

interface CarrierBalanceServiceInterface
{
    /**
     * @param CarrierInterface $carrier
     * @param float $amount
     * @return array
     */
    public function incrementBalance(CarrierInterface $carrier, float $amount);

    /**
     * @param CarrierInterface $carrier
     * @param float $amount
     * @return array
     */
    public function decrementBalance(CarrierInterface $carrier, float $amount);

    /**
     * @param int $brandId
     * @param array $carrierIds
     * @return \stdClass
     */
    public function getBalances($brandId, array $carrierIds);

    /**
     * @param int $brandId
     * @param int $carrierId
     * @return mixed
     */
    public function getBalance($brandId, $carrierId);
}
