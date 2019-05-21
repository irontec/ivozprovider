<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\Trusted;

use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Kam\Domain\Service\Trusted\TrustedLifecycleEventHandlerInterface;

class SendTrunksPermissionsReloadRequest implements TrustedLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

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
    public function execute(TrustedInterface $trusted)
    {
        $this->trunksClient->reloadTrustedPermissions();
    }
}
