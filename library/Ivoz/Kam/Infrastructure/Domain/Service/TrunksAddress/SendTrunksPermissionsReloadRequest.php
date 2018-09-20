<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\TrunksAddress;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;
use Ivoz\Kam\Domain\Service\TrunksAddress\TrunksAddressLifecycleEventHandlerInterface;

class SendTrunksPermissionsReloadRequest implements TrunksAddressLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $trunksPermissionsReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksPermissionsReload
    ) {
        $this->trunksPermissionsReload = $trunksPermissionsReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(TrunksAddressInterface $entity)
    {
        $this->trunksPermissionsReload->send();
    }
}
