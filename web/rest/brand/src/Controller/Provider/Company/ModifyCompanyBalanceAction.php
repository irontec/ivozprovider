<?php

namespace Controller\Provider\Company;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Service\Company\DecrementBalance;
use Ivoz\Provider\Domain\Service\Company\IncrementBalance;
use Symfony\Component\HttpFoundation\Request;

class ModifyCompanyBalanceAction
{
    const INCREMENT_OPERATION = 'increment';
    const DECREMENT_OPERATION = 'decrement';
    public function __construct(
        private IncrementBalance $incrementBalance,
        private DecrementBalance $decrementBalance,
        private CompanyRepository $companyRepository
    ) {
    }

    public function __invoke(Request $request): CompanyInterface
    {
        $companyId = (int) $request->attributes->get('id');
        $operation = $request->request->get('operation');
        $amount = (float) $request->request->get('amount');

        $success = match ($operation) {
            self::INCREMENT_OPERATION => $this->incrementBalance->execute($companyId, $amount),
            self::DECREMENT_OPERATION => $this->decrementBalance->execute($companyId, $amount),
            default => throw new \DomainException('Unexpected operation value')
        };

        if (!$success) {
            throw new \DomainException('Unable to modify company balance', 400);
        }

        /** @var CompanyInterface $company */
        $company = $this->companyRepository->find(
            $companyId
        );
        return $company;
    }
}
