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
    private $tokenStorage;
    private $companyServiceRepository;
    private $brandServiceRepository;
    private $serviceRepository;
    private $requestStack;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        CompanyServiceRepository $companyServiceRepository,
        BrandServiceRepository $brandServiceRepository,
        ServiceRepository $ratingPlanGroupRepository,
        RequestStack $requestStack
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->companyServiceRepository = $companyServiceRepository;
        $this->brandServiceRepository = $brandServiceRepository;
        $this->serviceRepository = $ratingPlanGroupRepository;
        $this->requestStack = $requestStack;
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
            $company->getBrand()->getId()
        );
        $services = $this->serviceRepository->getServicesInGroup($serviceIds);

        $serviceIdsAlreadyInUse = $this->companyServiceRepository->findServiceIdsByCompany(
            $company->getId()
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
