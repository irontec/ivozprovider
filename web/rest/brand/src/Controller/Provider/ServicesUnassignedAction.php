<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ServicesUnassignedAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private BrandServiceRepository $brandServiceRepository,
        private ServiceRepository $serviceRepository,
        private RequestStack $requestStack
    ) {
    }

    /**
     * @return ServiceInterface[]
     * @throws ResourceClassNotFoundException
     */
    public function __invoke(): array
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $admin */
        $admin = $token->getUser();
        $brand = $admin->getBrand();

        if (!$brand) {
            throw new ResourceClassNotFoundException('Brand not found');
        }

        /** @var ServiceInterface[] $services */
        $services = $this
            ->serviceRepository
            ->findAll();

        $serviceIdsAlreadyInUse = $this
            ->brandServiceRepository
            ->getServiceIdsByBrand(
                (int) $brand->getId()
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
