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

    /**
     * @return void
     */
    public function execute(DdiProviderInterface $ddiProvider)
    {
        $wasRemoved = $ddiProvider->hasBeenDeleted();
        if (!$wasRemoved) {
            return;
        }

        $this->trunksClient->reloadAddressPermissions();
    }
}
