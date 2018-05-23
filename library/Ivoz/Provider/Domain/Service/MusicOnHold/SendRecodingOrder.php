<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Recoder;

/**
 * Class RecodingOrder
 * @package Ivoz\Provider\Domain\Service\MusicOnHold
 */
class SendRecodingOrder implements MusicOnHoldLifecycleEventHandlerInterface
{
    /**
     * @var Recoder
     */
    protected $recoder;

    public function __construct(
        Recoder $recoder
    ) {
        $this->recoder = $recoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(MusicOnHoldInterface $entity)
    {
        $pendingStatus = $entity->getStatus() === 'pending';
        $statusHasChanged = $entity->hasChanged('status');

        if ($pendingStatus && $statusHasChanged) {
            $this->recoder
                ->setId($entity->getId())
                ->setEntityName(MusicOnHold::class)
                ->send();
        }

    }
}