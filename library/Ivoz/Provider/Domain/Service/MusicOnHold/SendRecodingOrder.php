<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use IvozProvider\Gearmand\Jobs\Recoder;

/**
 * Class RecodingOrder
 * @package Ivoz\Provider\Domain\Service\MusicOnHold
 */
class SendRecodingOrder implements MusicOnHoldLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(MusicOnHoldInterface $entity)
    {
        $pendingStatus = $entity->getStatus() === 'pending';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {

            $recoderJob = new Recoder();
            $recoderJob
                ->setId($entity->getId())
                ->setModelName("MusicOnHold")
                ->send();
        }
    }
}