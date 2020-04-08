<?php

namespace Services;

use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class JwtToken
{
    private $jwtManager;

    public function __construct(
        JWTTokenManagerInterface $jwtManager
    ) {
        $this->jwtManager = $jwtManager;
    }

    public function getPayload(string $jsonWebToken)
    {
        $preAuthToken = new PreAuthenticationJWTUserToken(
            $jsonWebToken
        );
        $payload = $this->jwtManager->decode(
            $preAuthToken
        );

        try {
            if (!$payload) {
                throw new InvalidTokenException('Invalid JWT Token');
            }

            return $payload;
        } catch (JWTDecodeFailureException $e) {
            if (JWTDecodeFailureException::EXPIRED_TOKEN === $e->getReason()) {
                throw new ExpiredTokenException();
            }

            throw new InvalidTokenException('Invalid JWT Token', 0, $e);
        }
    }
}
