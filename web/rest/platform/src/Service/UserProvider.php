<?php

namespace Service;

use Ivoz\Provider\Infrastructure\Api\Security\User\UserProviderTrait;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

class UserProvider implements UserProviderInterface
{
    use UserProviderTrait;

    /**
     * @param array $criteria
     * @return null | AdministratorInterface
     */
    protected function findUser(array $criteria)
    {
        return $this
            ->getRepository()
            ->findOneBy($criteria);
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
