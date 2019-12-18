<?php
namespace Ivoz\Provider\Domain\Service\HuntGroupsRelUser;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements HuntGroupsRelUserLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param HuntGroupsRelUserInterface $entity
     *
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(HuntGroupsRelUserInterface $entity)
    {
        $this->assertUnchanged(
            $entity,
            [
                'timeoutTime',
                'priority',
            ]
        );
    }
}
