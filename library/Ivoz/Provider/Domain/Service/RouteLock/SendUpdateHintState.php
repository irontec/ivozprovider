<?php

namespace Ivoz\Provider\Domain\Service\RouteLock;

use Ivoz\Ast\Infrastructure\Redis\Job\HintUpdateJob;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;

/**
 * Class SendDialplanReload
 * @package Ivoz\Provider\Domain\Service\RouteLock
 */
class SendUpdateHintState implements RouteLockLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private HintUpdateJob $hintUpdateJob
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(RouteLockInterface $routeLock): void
    {
        // Only status updated locks
        if (!$routeLock->hasChanged('open')) {
            return;
        }

        $deviceSate = $routeLock->isOpen()
            ? "NOT_INUSE"
            : "INUSE";

        $deviceName = $routeLock->getHintDeviceName();

        // Send Dialplan reload request to all asterisk
        $this
            ->hintUpdateJob
            ->setDeviceName($deviceName)
            ->setDeviceState($deviceSate)
            ->send();
    }
}
