<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;

class SendTrunksLcrReloadRequest implements CarrierServerLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksClientInterface $trunksClient
    ) {
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
    public function execute(CarrierServerInterface $carrierServer)
    {
        $this->trunksClient->reloadLcr();
    }
}
