<?php

namespace Controller\Provider\Company;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Service\Company\DecrementBalance;
use Ivoz\Provider\Domain\Service\Company\IncrementBalance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ModifyCompanyBalanceAction
{
    const INCREMENT_OPERATION = 'increment';
    const DECREMENT_OPERATION = 'decrement';
    public function __construct(
        private TokenStorageInterface $tokenStorage,
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

        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();
        /** @var AdministratorInterface $user */
        $user = $token->getUser();
        if (!$user->brandHasFeature('billing')) {
            throw new AccessDeniedHttpException();
        }

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
