<?php
namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdatePickupGroupByUser;

/**
 * Class UpdateEndpointGroups
 * @package Ivoz\Provider\Domain\Service\PickUpRelUser
 * @lifecycle post_persist|post_remove
 */
class UpdateEndpointGroups implements PickUpRelUserLifecycleEventHandlerInterface
{
    /**
     * @var UpdatePickupGroupByUser
     */
    protected $updatePickupGroupByUser;

    public function __construct(
        UpdatePickupGroupByUser $updatePickupGroupByUser
    ) {
        $this->updatePickupGroupByUser = $updatePickupGroupByUser;
    }

    public function execute(PickUpRelUserInterface $entity, $isNew)
    {
        $this->updatePickupGroupByUser->execute(
            $entity->getUser()
        );
    }
}