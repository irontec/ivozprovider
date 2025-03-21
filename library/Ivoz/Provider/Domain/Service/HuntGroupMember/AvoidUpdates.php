<?php

namespace Ivoz\Provider\Domain\Service\HuntGroupMember;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements HuntGroupMemberLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(HuntGroupMemberInterface $huntGroupMember): void
    {
        $this->assertUnchanged(
            $huntGroupMember,
            [
                'timeoutTime',
                'priority',
            ]
        );
    }
}
