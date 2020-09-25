<?php

namespace Ivoz\Provider\Infrastructure\Api\Timezone;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserTimezoneInjector
{
    const FALLBACK_TZ = 'UTC';

    protected $tokenStorage;
    protected $logger;
    protected $tzParamName;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        LoggerInterface $logger,
        $tzParamName = '_timezone'
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->logger = $logger;
        $this->tzParamName = $tzParamName;
    }

    /**
     * @return void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $alreadyDefinedTimezone = $request->query->has($this->tzParamName);
        if ($alreadyDefinedTimezone) {
            return;
        }

        $this->injectUserTimezoneInRequest($request);
    }

    /**
     * @return void
     */
    public function injectUserTimezoneInRequest(Request $request)
    {
        $timezoneStr = $this->getUserDateTimeZone();
        if (!$timezoneStr) {
            return;
        }

        $this->logger->debug(
            "Injecting {$this->tzParamName}={$timezoneStr} in the querystring"
        );
        $request->query->set(
            $this->tzParamName,
            $timezoneStr
        );
    }

    /**
     * @return string | null
     */
    private function getUserDateTimeZone()
    {
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return null;
        }

        /** @var AdministratorInterface | UserInterface $user */
        $user = $token->getUser();
        if (!$user instanceof EntityInterface) {
            return null;
        }

        $timeZone = $user->getTimezone();

        return $timeZone
            ? $timeZone->getTz()
            : self::FALLBACK_TZ;
    }
}
