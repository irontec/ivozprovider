<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;

class SendTrunksUacRegReloadRequest implements TrunksUacregLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

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
    public function execute(TrunksUacregInterface $entity)
    {
        $this->trunksClient->reloadUacReg();
    }
}
