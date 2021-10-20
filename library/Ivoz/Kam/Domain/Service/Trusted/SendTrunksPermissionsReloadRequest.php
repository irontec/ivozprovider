<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;

class SendTrunksPermissionsReloadRequest implements TrustedLifecycleEventHandlerInterface
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
    public function execute(TrustedInterface $trusted)
    {
        $this->trunksClient->reloadTrustedPermissions();
    }
}
