<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

class SendTrunksUacRegReloadRequest implements ProxyTrunkLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

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
    public function execute(ProxyTrunkInterface $proxyTrunk)
    {
        $this->trunksClient->reloadUacReg();
    }
}
