<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class SendUsersTrustedPermissionsReloadRequest implements CompanyLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    private $usersClient;

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
    public function execute(CompanyInterface $company)
    {
        $wasRemoved = $company->hasBeenDeleted();
        if (!$wasRemoved) {
            return;
        }

        if ($company->getType() !== CompanyInterface::TYPE_WHOLESALE) {
            return;
        }

        $this->usersClient->reloadTrustedPermissions();
    }
}
