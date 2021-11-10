<?php

namespace Ivoz\Provider\Domain\Service\DdiProvider;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;

class SendTrunksAddressPermissionsReloadRequest implements DdiProviderLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(DdiProviderInterface $ddiProvider): void
    {
        $wasRemoved = $ddiProvider->hasBeenDeleted();
        if (!$wasRemoved) {
            return;
        }

        $this->trunksClient->reloadAddressPermissions();
    }
}
