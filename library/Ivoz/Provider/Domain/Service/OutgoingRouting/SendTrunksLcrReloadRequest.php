<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRouting;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

class SendTrunksLcrReloadRequest implements OutgoingRoutingLifecycleEventHandlerInterface
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
    public function execute(OutgoingRoutingInterface $entity)
    {
        $this->trunksClient->reloadLcr();
    }
}
