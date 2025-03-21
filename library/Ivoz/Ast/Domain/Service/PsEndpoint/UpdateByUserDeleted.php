<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUserDeleted implements UserLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_REMOVE => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @return void
     */
    public function execute(UserInterface $user)
    {
        $endpoint = $user->getEndpoint();
        if (!$endpoint) {
            return;
        }

        /** @var PsEndpointDto $endpointDto */
        $endpointDto = $this
            ->entityTools
            ->entityToDto($endpoint);

        $endpointDto
            ->setCallerid(null)
            ->setMailboxes(null)
            ->setHintExtension(null)
            ->setNamedPickupGroup(null)
            ->setExtension(null);

        $this
            ->entityTools
            ->persistDto($endpointDto, $endpoint, false);
    }
}
