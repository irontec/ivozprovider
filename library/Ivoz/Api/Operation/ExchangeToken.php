<?php

namespace Ivoz\Api\Operation;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ExchangeToken
 * Get a token for requested username by a higher order token
 */
class ExchangeToken
{
    private $jwtTokenManager;
    private $eventDispatcher;
    private $userProvider;

    private $requiredInputRole;
    private $requiredOutputRole;
    private $ttl;

    public function __construct(
        JWTTokenManagerInterface $jwtTokenManager,
        EventDispatcherInterface $eventDispatcher,
        UserProviderInterface $userProvider,
        string $requiredInputRole = 'ROLE_SUPER_ADMIN',
        string $requiredOutputRole = 'ROLE_BRAND_ADMIN',
        string $ttl = '10 hour'
    ) {
        $this->jwtTokenManager = $jwtTokenManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->userProvider = $userProvider;

        $this->requiredInputRole = $requiredInputRole;
        $this->requiredOutputRole = $requiredOutputRole;
        $this->ttl = $ttl;
    }

    /**
     * @param string $inputToken
     * @param string $username
     * @return string
     * @throws ResourceClassNotFoundException
     */
    public function execute(string $inputToken, string $username): string
    {
        $superAdminToken = new JWTUserToken();
        $superAdminToken->setRawToken($inputToken);

        /** @var array | false $parentAdminTokenPayload */
        $parentAdminTokenPayload =  $this->jwtTokenManager->decode($superAdminToken);
        if (!$parentAdminTokenPayload) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $roles = $parentAdminTokenPayload['roles'] ?? [];
        if (!in_array($this->requiredInputRole, $roles, true)) {
            throw new \DomainException(
                'Input token must include ' . $this->requiredInputRole,
                403
            );
        }

        $targetAdmin =  $this->userProvider->loadUserByUsername($username);
        if (!$targetAdmin) {
            throw new \RuntimeException('Unable to find user ' . $username, 404);
        }

        $payloadModifier = function (JWTCreatedEvent $event) use ($parentAdminTokenPayload) {

            $exp = new \DateTime(
                '+' . $this->ttl,
                new \DateTimeZone('UTC')
            );

            $payload = $event->getData();
            if (!in_array($this->requiredOutputRole, $payload['roles'] ?? [], true)) {
                throw new \DomainException(
                    'Output token must include ' . $this->requiredOutputRole
                );
            }

            $payload['exp'] = $exp->getTimestamp();

            $tokenChain = [];
            if (isset($parentAdminTokenPayload['onBehalfOf'])) {
                $tokenChain[] = $parentAdminTokenPayload['onBehalfOf'];
            }
            $tokenChain[] = $parentAdminTokenPayload['username'];
            $payload['onBehalfOf'] = implode(',', $tokenChain);

            $event->setData($payload);
        };

        $this->eventDispatcher->addListener(
            Events::JWT_CREATED,
            $payloadModifier
        );

        $newToken = $this->jwtTokenManager->create($targetAdmin);
        $this->eventDispatcher->removeListener(
            Events::JWT_CREATED,
            $payloadModifier
        );

        return $newToken;
    }
}
