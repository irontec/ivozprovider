<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Provider\Domain\Service\PickUpRelUser\PickUpRelUserLifecycleEventHandlerInterface;

class UpdateByPickUpRelUser implements PickUpRelUserLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10,
            self::EVENT_POST_REMOVE => 10,
        ];
    }

    public function execute(PickUpRelUserInterface $entity, $isNew)
    {
        $user = $entity->getUser();
        if (!$user) {
            return;
        }

        $endpoint = $user->getEndpoint();
        if (!$endpoint) {
            return;
        }

        $endpoint->setNamedPickupGroup(
            $user->getPickUpGroupsIds()
        );

        $this
            ->entityPersister
            ->persist($endpoint);
    }
}
