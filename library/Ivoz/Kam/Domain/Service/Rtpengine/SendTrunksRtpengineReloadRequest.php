<?php

namespace Ivoz\Kam\Domain\Service\Rtpengine;

use Ivoz\Kam\Domain\Model\Rtpengine\RtpengineInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;

class SendTrunksRtpengineReloadRequest implements RtpengineLifecycleEventHandlerInterface
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
    public function execute(RtpengineInterface $rtpengine)
    {
        $this->trunksClient->reloadRtpengine();
    }
}
