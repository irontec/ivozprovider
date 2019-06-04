<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\DdiProvider;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Service\DdiProvider\DdiProviderLifecycleEventHandlerInterface;

class SendTrunksAddressPermissionsReloadRequest implements DdiProviderLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $trunksClient;

    public function __construct(
        TrunksClientInterface $trunksClient
    ) {
        $this->trunksClient = $trunksClient;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(DdiProviderInterface $ddiProvider)
    {
        $wasRemoved = $ddiProvider->hasBeenDeleted();
        if (!$wasRemoved) {
            return;
        }

        $this->trunksClient->reloadAddressPermissions();
    }
}
