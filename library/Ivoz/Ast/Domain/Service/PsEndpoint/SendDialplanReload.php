<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Infrastructure\Redis\Job\DialplanReloadJob;

/**
 * Class ReloadByExtension
 * @package Ivoz\Ast\Domain\Service\PsEndpoint
 */
class SendDialplanReload implements PsEndpointLifecycleEventHandlerInterface
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
    public function execute(PsEndpointInterface $psEndpoint): void
    {
        // Only if hint has changed
        if (!$psEndpoint->hasChanged('hint_extension')) {
            return;
        }

        // Send Dialplan reload request to all asterisk
        $this
            ->dialplanReloadJob
            ->send();
    }
}
