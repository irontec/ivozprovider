<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksDialplan;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksDialplanReload;
use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;
use Ivoz\Kam\Domain\Service\TrunksDialplan\TrunksDialplanLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements TrunksDialplanLifecycleEventHandlerInterface
{
    protected $trunksDialplanReload;

    public function __construct(
        RequestProxyTrunksDialplanReload $trunksDialplanReload
    ) {
        $this->trunksDialplanReload = $trunksDialplanReload;
    }

    public function execute(TrunksDialplanInterface $entity)
    {
        $this->trunksDialplanReload->send();
    }
}