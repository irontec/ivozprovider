<?php

namespace Service;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Infrastructure\Api\Security\User\UserProviderTrait;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

class UserProvider implements UserProviderInterface
{
    use UserProviderTrait;

    protected function findUser(string $identity): ?AdministratorInterface
    {
        /** @var AdministratorRepository $repository */
        $repository = $this->getRepository();

        return $repository->findPlatformAdminByUsername($identity);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        $isAdmin =
            $class === Administrator::class
            || is_subclass_of($class, Administrator::class);

        return $isAdmin;
    }
}
