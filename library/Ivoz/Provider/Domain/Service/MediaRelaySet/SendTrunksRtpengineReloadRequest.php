<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySet;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;

class SendTrunksRtpengineReloadRequest implements MediaRelaySetLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
    }

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY,
        ];
    }

    public function execute(MediaRelaySetInterface $mediaRelaySet): void
    {
        $mustReloadRtpengine = $mediaRelaySet->hasBeenDeleted();
        if (!$mustReloadRtpengine) {
            return;
        }

        $this->trunksClient->reloadRtpengine();
    }
}
