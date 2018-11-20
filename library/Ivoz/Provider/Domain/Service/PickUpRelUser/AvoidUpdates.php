<?php
namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements PickUpRelUserLifecycleEventHandlerInterface
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
     * @param PickUpRelUserInterface $entity
     * @throws \DomainException
     */
    public function execute(PickUpRelUserInterface $entity)
    {
        $this->assertUnchanged($entity);
    }
}
