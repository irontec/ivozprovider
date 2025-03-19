<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class UsersForIsbcAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @return UserInterface[]
     */
    public function __invoke(Request $request): array
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();

        $brandId = $user->getBrand()?->getId() ?? -1;

        /** @var ?int $locationId */
        $locationId = $request->query->get('location', null);

        return $this
            ->userRepository
            ->findByLocationAndBrand(
                $locationId,
                $brandId,
            );
    }
}
