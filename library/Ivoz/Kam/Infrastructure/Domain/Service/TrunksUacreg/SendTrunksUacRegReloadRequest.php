<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksUacreg;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Kam\Domain\Service\TrunksUacreg\TrunksUacregLifecycleEventHandlerInterface;

class SendTrunksUacRegReloadRequest implements TrunksUacregLifecycleEventHandlerInterface
{
    protected $trunksUacRegReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksUacRegReload
    ) {
        $this->trunksUacRegReload = $trunksUacRegReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(TrunksUacregInterface $entity, $isNew)
    {
        $this->trunksUacRegReload->send();
    }
}