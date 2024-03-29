<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class SendUsersAddressPermissionsReloadRequest implements CompanyLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private UsersClientInterface $usersClient
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        $wasRemoved = $company->hasBeenDeleted();
        if (!$wasRemoved) {
            return;
        }

        if ($company->getType() === CompanyInterface::TYPE_WHOLESALE) {
            return;
        }

        $this->usersClient->reloadAddressPermissions();
    }
}
