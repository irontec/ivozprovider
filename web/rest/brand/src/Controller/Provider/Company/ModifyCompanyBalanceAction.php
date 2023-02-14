<?php

namespace Controller\Provider\Company;

use Ivoz\Provider\Domain\Service\Company\DecrementBalance;
use Ivoz\Provider\Domain\Service\Company\IncrementBalance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModifyCompanyBalanceAction
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
        $companyId = (int) $request->attributes->get('id');
        $operation = $request->request->get('operation');
        $balanceValue = (int) $request->request->get('value');

        $result = match ($operation) {
            self::INCREMENT_OPERATION => $this->incrementBalance->execute($companyId, $balanceValue),
            self::DECREMENT_OPERATION => $this->decrementBalance->execute($companyId, $balanceValue),
            default => throw new \DomainException('Unexpected operation value')
        };

        if (!$result) {
            throw new \DomainException('Cannot increment company balance', 400);
        }

        return new Response('Balance Incremented', 200);
    }
}
