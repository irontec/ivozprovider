<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements PickUpRelUserLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param PickUpRelUserInterface $relUser
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(PickUpRelUserInterface $relUser)
    {
        $this->assertUnchanged($relUser);
    }
}
