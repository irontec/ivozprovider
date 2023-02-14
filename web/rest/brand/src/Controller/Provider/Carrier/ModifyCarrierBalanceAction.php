<?php

namespace Controller\Provider\Carrier;

use Ivoz\Provider\Domain\Service\Carrier\DecrementBalance;
use Ivoz\Provider\Domain\Service\Carrier\IncrementBalance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModifyCarrierBalanceAction
{
    const INCREMENT_OPERATION = 'increment';
    const DECREMENT_OPERATION = 'decrement';
    public function __construct(
        private IncrementBalance $incrementBalance,
        private DecrementBalance $decrementBalance
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $carrierId = (int) $request->attributes->get('id');
        $operation = $request->request->get('operation');
        $balanceValue = (int) $request->request->get('value');

        $result = match ($operation) {
            self::INCREMENT_OPERATION => $this->incrementBalance->execute($carrierId, $balanceValue),
            self::DECREMENT_OPERATION => $this->decrementBalance->execute($carrierId, $balanceValue),
            default => throw new \DomainException('Unexpected operation value')
        };

        if (!$result) {
            throw new \DomainException('Cannot increment company balance', 400);
        }

        return new Response('Balance Incremented', 200);
    }
}
