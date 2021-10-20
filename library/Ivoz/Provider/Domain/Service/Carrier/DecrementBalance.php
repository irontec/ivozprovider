<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

class DecrementBalance extends AbstractBalanceOperation
{
    /**
     * @param int $carrierId
     * @param float $amount
     * @return boolean
     */
    public function execute($carrierId, float $amount): bool
    {
        $this->logger->info('Carrier#%s\'s balance will be decreased by ' . $amount);
        $carrier = $this->carrierRepository->find($carrierId);
        $response = $this->client->decrementBalance($carrier, $amount);

        return $this->handleResponse(
            ($amount * -1),
            $response,
            $carrier
        );
    }
}
