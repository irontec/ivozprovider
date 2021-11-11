<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ServicesUnassignedAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CompanyServiceRepository $companyServiceRepository,
        private BrandServiceRepository $brandServiceRepository,
        private ServiceRepository $serviceRepository,
        private RequestStack $requestStack
    ) {
    }

    public function __invoke()
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $admin */
        $admin = $token->getUser();
        $company = $admin->getCompany();
        $serviceIds = $this->brandServiceRepository->getServiceIdsByBrand(
            (int) $company->getBrand()->getId()
        );
        $services = $this->serviceRepository->getServicesInGroup($serviceIds);

        $serviceIdsAlreadyInUse = $this->companyServiceRepository->findServiceIdsByCompany(
            (int) $company->getId()
        );

        $includeId = $request->query->get('_includeId');
        foreach ($services as $k => $service) {
            $id = $service->getId();
            if ($id == $includeId) {
                continue;
            }

            if (in_array($id, $serviceIdsAlreadyInUse)) {
                unset($services[$k]);
            }
        }

        return array_values($services);
    }
}
