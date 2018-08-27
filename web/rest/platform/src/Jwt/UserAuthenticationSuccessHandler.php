<?php

namespace Jwt;

use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler as OriginalAuthenticationSuccessHandler;

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
