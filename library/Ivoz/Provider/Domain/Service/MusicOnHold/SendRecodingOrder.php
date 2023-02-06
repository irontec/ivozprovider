<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Job\RecoderJobInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

class SendRecodingOrder implements MusicOnHoldLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private RecoderJobInterface $recoder
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
    public function execute(MusicOnHoldInterface $musicOnHold)
    {
        if ($musicOnHold->hasBeenDeleted()) {
            return;
        }

        $pendingStatus = $musicOnHold->getStatus() === 'pending';
        $statusHasChanged = $musicOnHold->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->recoder
                ->setId($musicOnHold->getId())
                ->setEntityName(MusicOnHold::class)
                ->send();
        }
    }
}
