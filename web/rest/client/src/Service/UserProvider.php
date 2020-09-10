<?php

namespace Service;

use Ivoz\Provider\Infrastructure\Api\Security\User\MutableUserProviderInterface;
use Ivoz\Provider\Infrastructure\Api\Security\User\UserProviderTrait;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

class UserProvider implements UserProviderInterface, MutableUserProviderInterface
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
        $isAdmin =
            $class === Administrator::class
            || is_subclass_of($class, Administrator::class);

        $isUser =
            $class === User::class
            || is_subclass_of($class, User::class);

        switch ($this->entityClass) {
            case User::class:
                return $isUser;

            case Administrator::class:
                return $isAdmin;
        }

        return false;
    }
}
