<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySet;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;

class SendUsersRtpengineReloadRequest implements MediaRelaySetEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private UsersClientInterface $usersClient
    ) {
    }

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY,
        ];
    }

    /**
     * @return void
     */
    public function execute(MediaRelaySetInterface $mediaRelaySet): void
    {
        $mustReloadRtpengine = $mediaRelaySet->hasBeenDeleted();
        if (!$mustReloadRtpengine) {
            return;
        }

        $this->usersClient->reloadRtpengine();
    }
}
