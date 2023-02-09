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
     * @param DestinationRateGroupInterface $entity
     *
     * @return void
     */
    public function execute(DestinationRateGroupInterface $entity)
    {
        if ($entity->hasBeenDeleted()) {
            return;
        }

        $pendingStatus = $entity->getStatus() === 'waiting';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->importer
                ->setParams(['id' => $entity->getId()])
                ->send();
        }
    }
}
