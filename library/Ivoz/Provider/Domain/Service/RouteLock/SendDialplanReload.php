<?php

namespace Ivoz\Provider\Domain\Service\RouteLock;

use Ivoz\Ast\Infrastructure\Redis\Job\DialplanReloadJob;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;

/**
 * Class SendDialplanReload
 * @package Ivoz\Provider\Domain\Service\RouteLock
 */
class SendDialplanReload implements RouteLockLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private DialplanReloadJob $dialplanReloadJob
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function execute(RouteLockInterface $routeLock): void
    {
        // Only for new or deleted RouteLocks
        if ($routeLock->isNew() || $routeLock->hasBeenDeleted()) {
            // Send Dialplan reload request to all asterisk
            $this
                ->dialplanReloadJob
                ->send();
        }
    }
}
