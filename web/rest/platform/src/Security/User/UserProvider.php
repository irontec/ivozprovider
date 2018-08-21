<?php

namespace Security\User;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\User\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    private $registry;
    private $managerName;
    private $entityClass;
    private $identifierField;

    public function __construct(ManagerRegistry $registry, $managerName = null, string $entityClass, string $identifierField)
    {
        $this->registry = $registry;
        $this->managerName = $managerName;

        $this->entityClass = $entityClass;
        $this->identifierField = $identifierField;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setEntityClass(string $class)
    {
        $this->entityClass = $class;

        return $this;
    }

    /**
     * @param string $identifierField
     * @return $this
     */
    public function setUserIdentityField(string $identifierField)
    {
        $this->identifierField = $identifierField;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $repository = $this->getRepository();
        $user = $repository->findOneBy(array($this->identifierField => $username));

        if (null === $user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = $this->getClass();
        if (!$user instanceof $class) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $repository = $this->getRepository();

        // The user must be reloaded via the primary key as all other data
        // might have changed without proper persistence in the database.
        // That's the case when the user has been changed by a form with
        // validation errors.
        if (!$id = $this->getClassMetadata()->getIdentifierValues($user)) {
            throw new \InvalidArgumentException('You cannot refresh a user '.
                'from the EntityUserProvider that does not contain an identifier. '.
                'The user object has to be serialized with its own identifier '.
                'mapped by Doctrine.'
            );
        }

        $refreshedUser = $repository->find($id);
        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($id)));
        }

        return $refreshedUser;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return
            ($class === Administrator::class || is_subclass_of($class, Administrator::class))
            || ($class === User::class || is_subclass_of($class, User::class));
    }

    private function getObjectManager()
    {
        return $this->registry->getManager($this->managerName);
    }

    private function getRepository()
    {
        return $this->getObjectManager()->getRepository($this->entityClass);
    }

    private function getClassMetadata()
    {
        return $this->getObjectManager()->getClassMetadata($this->entityClass);
    }
}