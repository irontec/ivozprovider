<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Provider\Domain\Service\PickUpRelUser\PickUpRelUserLifecycleEventHandlerInterface;

class UpdateByPickUpRelUser implements PickUpRelUserLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10,
            self::EVENT_POST_REMOVE => 10,
        ];
    }

    public function execute(PickUpRelUserInterface $pickUpRelUser)
    {
        $user = $pickUpRelUser->getUser();
        if (!$user) {
            return;
        }

        $endpoint = $user->getEndpoint();
        if (!$endpoint) {
            return;
        }

        /** @var PsEndpointDto $endpointDto */
        $endpointDto = $this
            ->entityTools
            ->entityToDto($endpoint);

        $endpointDto->setNamedPickupGroup(
            $user->getPickUpGroupsIds()
        );

        $this
            ->entityTools
            ->persistDto(
                $endpointDto,
                $endpoint,
                false
            );
    }
}
