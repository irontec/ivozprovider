<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\Trusted;

use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Ivoz\Kam\Domain\Service\Trusted\TrustedLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;

class SendUsersPermissionsReloadRequest implements TrustedLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_HIGH;

    protected $usersClient;

    public function __construct(
        UsersClientInterface $usersClient
    ) {
        $this->usersClient = $usersClient;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(TrustedInterface $trusted)
    {
        $this->usersClient->reloadTrustedPermissions();
    }
}
