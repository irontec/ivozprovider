<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Service\UsersLocation\CompanyRegistrationSummary;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\RegistrationSummary;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class RegistrationSummaryAction
{
    protected $requestStack;
    protected $tokenStorage;
    protected $companyRegistrationSummary;

    public function __construct(
        RequestStack $requestStack,
        TokenStorage $tokenStorage,
        CompanyRegistrationSummary $companyRegistrationSummary
    ) {
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
        $this->companyRegistrationSummary = $companyRegistrationSummary;
    }

    public function __invoke()
    {
        /** @var TokenInterface|null $token */
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

        $userLocations = $this->companyRegistrationSummary->getUsersLocations(
            $company
        );

        $total = $this->companyRegistrationSummary->getDeviceNumber(
            $company
        );

        $active = count(
            $userLocations
        );

        return new RegistrationSummary(
            $active,
            $total
        );
    }
}
