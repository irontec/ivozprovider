<?php

namespace Ivoz\Kam\Domain\Service\Rtpengine;

use Ivoz\Kam\Domain\Model\Rtpengine\RtpengineInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;

class SendTrunksRtpengineReloadRequest implements RtpengineLifecycleEventHandlerInterface
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
    public function execute(RtpengineInterface $entity)
    {
        $this->trunksClient->reloadRtpengine();
    }
}
