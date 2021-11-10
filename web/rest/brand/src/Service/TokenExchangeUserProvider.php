<?php

namespace Service;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Infrastructure\Api\Security\User\UserProviderTrait;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

class TokenExchangeUserProvider extends UserProvider
{
    protected function findUser(string $identity): ?AdministratorInterface
    {
        $user = parent::findUser($identity);

        if (!$user) {
            return null;
        }

        if (!$user->isEnabled() && !$user->getInternal()) {
            throw new \Exception('User not found');
        }

        return $user;
    }
}
