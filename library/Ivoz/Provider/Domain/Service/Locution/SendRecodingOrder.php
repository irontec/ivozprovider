<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Recoder;

/**
 * Class RecodingOrder
 * @package Ivoz\Provider\Domain\Service\Locution
 */
class SendRecodingOrder implements LocutionLifecycleEventHandlerInterface
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
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(LocutionInterface $entity)
    {
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