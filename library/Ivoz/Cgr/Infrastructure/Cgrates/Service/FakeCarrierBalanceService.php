<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

class FakeCarrierBalanceService extends CarrierBalanceService
{
    private float $balance = 0;

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface::incrementBalance
     * @inheritdoc
     * @return array<string, boolean|null>
     */
    public function incrementBalance(CarrierInterface $carrier, float $amount): array
    {
        $this->balance = $carrier->getBalance() + $amount;

        return [
            'success' => true,
            'error' => null,
        ];
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface::decrementBalance
     * @inheritdoc
     * @return array<string, boolean|null>
     */
    public function decrementBalance(CarrierInterface $carrier, float $amount): array
    {
        $this->balance = $carrier->getBalance() - $amount;

        return [
            'success' => true,
            'error' => null,
        ];
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface::getBalances
     * @inheritdoc
     * @param int $brandId
     * @param array<int> $carrierIds
     */
    public function getBalances($brandId, array $carrierIds)
    {
        $response = new \stdClass();

        $response->error = null;
        $response->result = [];

        foreach ($carrierIds as $carrierId) {
            $response->result[$carrierId] = $this->balance;
        }

        return $response;
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface::getBalance
     * @inheritdoc
     */
    public function getBalance($brandId, $carrierId)
    {
        return $this->balance;
    }

    public function getCurrentDayUsage(int $brandId, int $carrierId): ?float
    {
        throw new \Exception('TODO');
    }
}
