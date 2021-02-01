<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;

class SendTrunksPermissionsReloadRequest implements TrunksAddressLifecycleEventHandlerInterface
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
    public function execute(TrunksAddressInterface $entity)
    {
        $this->trunksClient->reloadAddressPermissions();
    }
}
