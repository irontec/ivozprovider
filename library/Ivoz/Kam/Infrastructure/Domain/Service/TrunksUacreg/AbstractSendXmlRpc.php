<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksUacreg;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksUacRegReload;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Kam\Domain\Service\TrunksUacreg\TrunksUacregLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements TrunksUacregLifecycleEventHandlerInterface
{
    protected $trunksUacRegReload;

    public function __construct(
        RequestProxyTrunksUacRegReload $trunksUacRegReload
    ) {
        $this->trunksUacRegReload = $trunksUacRegReload;
    }

    public function execute(TrunksUacregInterface $entity, $isNew)
    {
        $this->trunksUacRegReload->send();
    }
}