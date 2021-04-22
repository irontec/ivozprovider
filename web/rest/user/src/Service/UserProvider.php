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

    /**
     * @param array $criteria
     * @return null | UserInterface
     */
    protected function findUser(array $criteria)
    {
        $user = $this
            ->getRepository()
            ->findOneBy($criteria);

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
     * @param string $identifierField
     * @return $this
     */
    public function setUserIdentityField(string $identifierField): MutableUserProviderInterface
    {
        $this->identifierField = $identifierField;

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
