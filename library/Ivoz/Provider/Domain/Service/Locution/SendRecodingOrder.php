<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Job\RecoderJobInterface;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class SendRecodingOrder implements LocutionLifecycleEventHandlerInterface
{
    public function __construct(
        private RecoderJobInterface $recoder
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(LocutionInterface $locution)
    {
        if ($locution->hasBeenDeleted()) {
            return;
        }

        $pendingStatus = $locution->getStatus() === 'pending';
        $statusHasChanged = $locution->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->recoder
                ->setId($locution->getId())
                ->setEntityName(Locution::class)
                ->send();
        }
    }
}
