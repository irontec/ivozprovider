<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Kam\Domain\Service\UsersLocation\BrandRegistrationSummary;
use Ivoz\Kam\Domain\Service\UsersLocation\CompanyRegistrationSummary;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\RegistrationSummary;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegistrationSummaryAction
{
    public function __construct(
        private RequestStack $requestStack,
        private TokenStorageInterface $tokenStorage,
        private CompanyRegistrationSummary $companyRegistrationSummary,
        private BrandRegistrationSummary $brandRegistrationSummary
    ) {
    }

    public function __invoke()
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();
        $brand = $user->getBrand();

        if (!$brand) {
            throw new NotFoundHttpException('Brand not found');
        }

        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $companyId = $request->query->get('company');

        if (!$companyId) {
            $userLocations = $this->brandRegistrationSummary->getUsersLocations(
                $brand
            );

            $total = $this->brandRegistrationSummary->getDeviceNumber(
                (int) $brand->getId()
            );
        } else {
            $companies = $brand->getCompanies(CriteriaHelper::fromArray([
                ['id', 'eq', $companyId]
            ]));

            if (empty($companies)) {
                throw new NotFoundHttpException('Company not found');
            }
            $company = $companies[0];

            $userLocations = $this->companyRegistrationSummary->getUsersLocations(
                $company
            );

            $total = $this->companyRegistrationSummary->getDeviceNumber(
                $company
            );
        }

        $active = count($userLocations);

        return new RegistrationSummary(
            $active,
            $total
        );
    }
}
