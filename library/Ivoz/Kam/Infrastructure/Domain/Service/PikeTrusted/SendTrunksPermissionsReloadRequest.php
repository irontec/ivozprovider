<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\PikeTrusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;
use Ivoz\Kam\Domain\Service\PikeTrusted\PikeTrustedLifecycleEventHandlerInterface;

class SendTrunksPermissionsReloadRequest implements PikeTrustedLifecycleEventHandlerInterface
{
    protected $trunksPermissionsReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksPermissionsReload
    ) {
        $this->trunksPermissionsReload = $trunksPermissionsReload;
    }

    public function execute(PikeTrustedInterface $entity)
    {
        $this->trunksPermissionsReload->send();
    }
}