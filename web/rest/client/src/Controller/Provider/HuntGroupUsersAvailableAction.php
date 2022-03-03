<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupRepository;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserRepository;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class HuntGroupUsersAvailableAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private HuntGroupRepository $huntGroupRepository,
        private HuntGroupsRelUserRepository $huntGroupsRelUserRepository,
        private UserRepository $userRepository,
        private RequestStack $requestStack,
        private DenormalizerInterface $denormalizer
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
        /** @var CompanyInterface $company */
        $company = $admin->getCompany();

        $id = (int) $request->attributes->get('id');
        /** @var ?HuntGroupInterface $huntGroup */
        $huntGroup = $this->huntGroupRepository->find($id);

        if (!$huntGroup || $huntGroup->getCompany() !== $company) {
            throw new ResourceClassNotFoundException('HuntGroup not found');
        }

        $excludedUserIds = $this->huntGroupsRelUserRepository->findUserIdsInHuntGroup(
            $huntGroup->getId()
        );

        $includeId = (int) $request->query->get('_includeId');
        if (($key = array_search($includeId, $excludedUserIds)) !== false) {
            unset($excludedUserIds[$key]);
        }

        $users = $this->userRepository->findCompanyUsersExcludingIds(
            $company->getId(),
            $excludedUserIds
        );

        $response = [];
        foreach ($users as $user) {
            $response[] = $this->denormalizer->denormalize(
                [],
                User::class,
                $request->getRequestFormat(),
                [
                    'object_to_populate' => $user,
                    'operation_normalization_context' => UserDto::CONTEXT_COLLECTION
                ]
            );
        }

        return $response;
    }
}
