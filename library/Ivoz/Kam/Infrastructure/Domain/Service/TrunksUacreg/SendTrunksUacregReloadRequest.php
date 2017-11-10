<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksUacreg;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Kam\Domain\Service\TrunksUacreg\TrunksUacregLifecycleEventHandlerInterface;

class SendTrunksUacregReloadRequest implements TrunksUacregLifecycleEventHandlerInterface
{
    protected $trunksUacregReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksUacregReload
    ) {
        $this->trunksUacregReload = $trunksUacregReload;
    }

    public function execute(TrunksUacregInterface $entity, $isNew)
    {
        $this->trunksUacregReload->send();
    }
}