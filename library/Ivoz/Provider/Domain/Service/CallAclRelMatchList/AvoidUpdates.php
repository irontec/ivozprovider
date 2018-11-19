<?php
namespace Ivoz\Provider\Domain\Service\CallAclRelMatchList;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements CallAclRelMatchListLifecycleEventHandlerInterface
{
    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }

    /**
     * @param CallAclRelMatchListInterface $entity
     * @throws \DomainException
     */
    public function execute(CallAclRelMatchListInterface $entity)
    {
        $this->assertUnchanged(
            $entity,
            [
                'priority',
                'policy'
            ]
        );
    }
}
