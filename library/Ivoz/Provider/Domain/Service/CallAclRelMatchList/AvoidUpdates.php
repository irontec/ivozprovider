<?php

namespace Ivoz\Provider\Domain\Service\CallAclRelMatchList;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements CallAclRelMatchListLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param CallAclRelMatchListInterface $relMatchList
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(CallAclRelMatchListInterface $relMatchList)
    {
        $this->assertUnchanged(
            $relMatchList,
            [
                'priority',
                'policy'
            ]
        );
    }
}
