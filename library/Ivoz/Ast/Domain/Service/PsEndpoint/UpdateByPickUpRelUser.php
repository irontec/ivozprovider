<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Provider\Domain\Service\PickUpRelUser\PickUpRelUserLifecycleEventHandlerInterface;

class UpdateByPickUpRelUser implements PickUpRelUserLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10,
            self::EVENT_POST_REMOVE => 10,
        ];
    }

    /**
     * @return void
     */
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
