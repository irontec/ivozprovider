<?php

namespace Ivoz\Provider\Domain\Service\GenericMusicOnHold;

use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHold;
use Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface;
use IvozProvider\Gearmand\Jobs\Recoder;

/**
 * Class SendRecodingOrder
 * @package Ivoz\Provider\Domain\Service\GenericMusicOnHold
 */
class SendRecodingOrder implements GenericMusicOnHoldLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(GenericMusicOnHoldInterface $entity)
    {
        $pendingStatus = $entity->getStatus() === 'pending';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {

            $recoderJob = new Recoder();
            $recoderJob
                ->setId($entity->getId())
                ->setEntityName(GenericMusicOnHold::class)
                ->send();
        }
    }
}