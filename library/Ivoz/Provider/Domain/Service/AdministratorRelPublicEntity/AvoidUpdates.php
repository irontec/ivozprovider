<?php

namespace Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements AdministratorRelPublicEntityLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }

    /**
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(AdministratorRelPublicEntityInterface $relPublicEntity)
    {
        $this->assertUnchanged(
            $relPublicEntity,
            [
                'create',
                'read',
                'update',
                'delete',
            ]
        );
    }
}
