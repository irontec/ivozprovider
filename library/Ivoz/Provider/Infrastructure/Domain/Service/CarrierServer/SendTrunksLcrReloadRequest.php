<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\CarrierServer;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Service\CarrierServer\CarrierServerLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements CarrierServerLifecycleEventHandlerInterface
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
    public function execute(CarrierServerInterface $carrierServer)
    {
        $this->trunksClient->reloadLcr();
    }
}
