<?php

namespace Controller\Provider;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CompaniesByCorporateUnassignedAction
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private FriendRepository $friendRepository,
        private TokenStorageInterface $tokenStorage
    ) {
    }

    /**
     * @return CompanyInterface[]
     */
    public function __invoke(Request $request): array
    {
        //$corporationId = (int) $request->query->get('_includeId');
        $token =  $this->tokenStorage->getToken();


        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $admin */
        $admin = $token->getUser();

        /** @var CompanyInterface $company */
        $company = $admin->getCompany();

        $corporation = $company->getCorporation();

        $response = [];

        if (is_null($corporation)) {
            return $response;
        }

        $corporationId = $corporation->getId();
        $companies = $this->companyRepository->findByCorporationId((int) $corporationId);

        if (is_null($companies)) {
            return $response;
        }

        foreach ($companies as $interCompany) {
            if ($company->getId() === $interCompany->getId()) {
                continue;
            }

            $friends = $this->friendRepository->findByCompanyAndInterCompany(
                (int) $company->getId(),
                (int) $interCompany->getId()
            );

            if (count($friends) !== 0) {
                continue;
            }

            $response[] = $interCompany;
        }

        return $response;
    }
}
