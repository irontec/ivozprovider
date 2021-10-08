<?php

namespace Ivoz\Provider\Infrastructure\Api\Security\User;

use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

trait UserProviderTrait
{
    public function __construct(
        private ManagerRegistry $registry,
        private RequestStack $requestStack,
        private LoggerInterface $logger,
        private string $entityClass,
        private string $identifierField,
        private $managerName = null
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        try {
            $user = $this->findUser([
                $this->identifierField => $username
            ]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw $e;
        }

        if (null === $user) {
            $errorMsg = sprintf('User "%s" not found.', $username);
            $this->logger->debug($errorMsg);
            throw new UsernameNotFoundException($errorMsg);
        }

        return $user;
    }

    abstract protected function findUser(array $criteria);

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof $this->entityClass) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $repository = $this->getRepository();

        // The user must be reloaded via the primary key as all other data
        // might have changed without proper persistence in the database.
        // That's the case when the user has been changed by a form with
        // validation errors.
        if (!$id = $this->getClassMetadata()->getIdentifierValues($user)) {
            throw new \InvalidArgumentException('You cannot refresh a user ' .
                'from the EntityUserProvider that does not contain an identifier. ' .
                'The user object has to be serialized with its own identifier ' .
                'mapped by Doctrine.');
        }

        $refreshedUser = $repository->find($id);
        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($id)));
        }

        return $refreshedUser;
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
