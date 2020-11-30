<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Carrier;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements CarrierLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $trunksClient;

    public function __construct(
        TrunksClientInterface $trunksClient
    ) {
        $this->trunksClient = $trunksClient;
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
    public function execute(CarrierInterface $entity)
    {
        $changeSet = $entity->getChangedFields();
        if (in_array('balance', $changeSet)
            && count($changeSet) === 1
        ) {
            return;
        }

        $this->trunksClient->reloadLcr();
    }
}
