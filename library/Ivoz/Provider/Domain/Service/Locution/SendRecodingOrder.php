<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Job\RecoderJobInterface;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class SendRecodingOrder implements LocutionLifecycleEventHandlerInterface
{
    protected $recoder;

    public function __construct(
        RecoderJobInterface $recoder
    ) {
        $this->recoder = $recoder;
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
    public function execute(LocutionInterface $entity)
    {
        if ($entity->hasBeenDeleted()) {
            return;
        }

        $pendingStatus = $entity->getStatus() === 'pending';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->recoder
                ->setId($entity->getId())
                ->setEntityName(Locution::class)
                ->send();
        }
    }
}
