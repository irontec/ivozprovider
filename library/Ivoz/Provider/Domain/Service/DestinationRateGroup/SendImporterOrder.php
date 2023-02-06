<?php

namespace Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Provider\Domain\Job\RatesImporterJobInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class SendImporterOrder implements DestinationRateGroupLifecycleEventHandlerInterface
{
    public function __construct(
        private RatesImporterJobInterface $importer
    ) {
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    /**
     * @param DestinationRateGroupInterface $destinationRateGroup
     *
     * @return void
     */
    public function execute(DestinationRateGroupInterface $destinationRateGroup)
    {
        if ($destinationRateGroup->hasBeenDeleted()) {
            return;
        }

        $pendingStatus = $destinationRateGroup->getStatus() === 'waiting';
        $statusHasChanged = $destinationRateGroup->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->importer
                ->setParams(['id' => $destinationRateGroup->getId()])
                ->send();
        }
    }
}
