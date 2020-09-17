<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Model\ActiveCalls;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ActiveCallsAction
{
    protected $tokenStorage;
    protected $requestStack;
    protected $trunksClient;
    protected $companyRepository;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        RequestStack $requestStack,
        TrunksClientInterface $trunksClient,
        CompanyRepository $companyRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
        $this->trunksClient = $trunksClient;
        $this->companyRepository = $companyRepository;
    }

    public function __invoke()
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
                $company->getId()
            );

        return new ActiveCalls(
            $activeCalls[0] ?? 0,
            $activeCalls[1] ?? 0
        );
        ;
    }
}
