<?php

namespace Ivoz\Provider\Infrastructure\Api\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler as OriginalAuthenticationSuccessHandler;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAuthenticationSuccessHandler extends OriginalAuthenticationSuccessHandler
{
    /**
     * @inheritdoc
     */
    public function handleAuthenticationSuccess(UserInterface $user, $jwt = null)
    {
        $this->jwtManager->setUserIdentityField('email');

        return parent::handleAuthenticationSuccess(...func_get_args());
    }
}
