<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\Rtpengine;

use Ivoz\Kam\Domain\Model\Rtpengine\RtpengineInterface;
use Ivoz\Kam\Domain\Service\Rtpengine\RtpengineLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;

class SendUsersRtpengineReloadRequest implements RtpengineLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $usersClient;

    public function __construct(
        UsersClientInterface $usersClient
    ) {
        $this->usersClient = $usersClient;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(RtpengineInterface $entity)
    {
        $this->usersClient->reloadRtpengine();
    }
}
