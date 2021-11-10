<?php

namespace Service;

use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Infrastructure\Api\Security\User\MutableUserProviderInterface;
use Ivoz\Provider\Infrastructure\Api\Security\User\UserProviderTrait;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface, MutableUserProviderInterface
{
    use UserProviderTrait;

    protected function findUser(string $identity): ?UserInterface
    {
        $user = $this
            ->getRepository()
            ->findOneBy([
                'email' => $identity
            ]);

        return $user;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setEntityClass(string $class): MutableUserProviderInterface
    {
        $this->entityClass = $class;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        $isUser =
            $class === User::class
            || is_subclass_of($class, User::class);

        return $isUser;
    }
}
