<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\Trusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Ivoz\Kam\Domain\Service\Trusted\TrustedLifecycleEventHandlerInterface;

class SendTrunksPermissionsReloadRequest implements TrustedLifecycleEventHandlerInterface
{
    protected $trunksPermissionsReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksPermissionsReload
    ) {
        $this->trunksPermissionsReload = $trunksPermissionsReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 20
        ];
    }

    public function execute(TrustedInterface $entity)
    {
        $this->trunksPermissionsReload->send();
    }
}