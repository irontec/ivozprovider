<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\ActiveCalls;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ActiveCallsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private TrunksClientInterface $trunksClient
    ) {
    }

    public function __invoke(): ActiveCalls
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();
        $company = $user->getCompany();
        if (!$company) {
            throw new NotFoundHttpException('Company not found');
        }

        $activeCalls = $this
            ->trunksClient
            ->getCompanyActiveCalls(
                (int) $company->getId()
            );

        return new ActiveCalls(
            $activeCalls[0] ?? 0,
            $activeCalls[1] ?? 0
        );
        ;
    }
}
