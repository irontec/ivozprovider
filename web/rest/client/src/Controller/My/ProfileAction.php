<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityRepository;
use Model\Profile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProfileAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private AdministratorRelPublicEntityRepository $adminRelPublicEntityRepository
    ) {
    }

    public function __invoke(): Profile
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

        $restricted = $user->getRestricted();

        /** @var AdministratorRelPublicEntityInterface[] $adminRelPublicEntities */
        $adminRelPublicEntities = [];
        if ($restricted) {
            $adminRelPublicEntities = $this
                ->adminRelPublicEntityRepository
                ->getByAdministratorId(
                    (int) $user->getId()
                );
        }

        $type = $company->getType();

        return new Profile(
            $restricted,
            $type,
            $adminRelPublicEntities
        );
    }
}
