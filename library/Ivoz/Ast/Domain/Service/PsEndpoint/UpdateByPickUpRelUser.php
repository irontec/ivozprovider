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
