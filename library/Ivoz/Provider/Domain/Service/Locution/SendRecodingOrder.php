<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use IvozProvider\Gearmand\Jobs\Recoder;

/**
 * Class RecodingOrder
 * @package Ivoz\Provider\Domain\Service\Locution
 */
class SendRecodingOrder implements LocutionLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(LocutionInterface $entity)
    {
        $pendingStatus = $entity->getStatus() === 'pending';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {

            //@todo this is not testable
            $recoderJob = new Recoder();
            $recoderJob
                ->setId($entity->getId())
                ->setEntityName(Locution::class)
                ->send();
        }
    }
}