<?php

namespace Ivoz\Provider\Infrastructure\Api\Timezone;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserTimezoneInjector
{
    public const FALLBACK_TZ = 'UTC';

    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private LoggerInterface $logger,
        private AdministratorRepository $administratorRepository,
        private string $tzParamName = '_timezone'
    ) {
    }

    /**
     * @return void
     */
    public function onKernelRequest(RequestEvent $event)
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

        $internalAdmin =
            $user instanceof AdministratorInterface
            && $user->getInternal();

        $parentTz = null;
        if ($internalAdmin) {
            $parentTz = $this->getParentTz($user);
        }

        $timeZone = $parentTz
            ? $parentTz
            : $user->getTimezone();

        return $timeZone
            ? $timeZone->getTz()
            : self::FALLBACK_TZ;
    }

    public function getParentTz(AdministratorInterface $admin): ?TimezoneInterface
    {
        $adminChain = array_reverse(
            explode(
                ' > ',
                $admin->getOnBehalfOf() ?? ''
            )
        );

        foreach ($adminChain as $parentAdmin) {
            $matched = preg_match(
                '/#([0-9]+)\]$/',
                $parentAdmin,
                $matches
            );

            $adminId = $matched
                ? (int)$matches['1']
                : -1;

            /** @var ?AdministratorInterface $originalAdmin */
            $originalAdmin = $this
                ->administratorRepository
                ->find($adminId);

            if (!$originalAdmin || $originalAdmin->getInternal()) {
                continue;
            }

            return $originalAdmin->getTimezone();
        }

        return null;
    }
}
