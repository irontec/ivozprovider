<?php

namespace Controller\Provider\Carrier;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Service\Carrier\DecrementBalance;
use Ivoz\Provider\Domain\Service\Carrier\IncrementBalance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ModifyCarrierBalanceAction
{
    const INCREMENT_OPERATION = 'increment';
    const DECREMENT_OPERATION = 'decrement';
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private IncrementBalance $incrementBalance,
        private DecrementBalance $decrementBalance,
        private CarrierRepository $carrierRepository
    ) {
    }

    public function __invoke(Request $request): CarrierInterface
    {
        $carrierId = (int) $request->attributes->get('id');
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
            self::INCREMENT_OPERATION => $this->incrementBalance->execute($carrierId, $amount),
            self::DECREMENT_OPERATION => $this->decrementBalance->execute($carrierId, $amount),
            default => throw new \DomainException('Unexpected operation value')
        };

        if (!$success) {
            throw new \DomainException('Unable to modify company balance', 400);
        }

        /** @var CarrierInterface $carrier */
        $carrier = $this->carrierRepository->find(
            $carrierId
        );

        return $carrier;
    }
}
