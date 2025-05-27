<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUserTerminalUnassignment implements UserLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private PsEndpointRepository $psEndpointRepository
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @return void
     */
    public function execute(UserInterface $user)
    {
        $terminalChanged = $user->hasChanged('terminalId');
        if (!$terminalChanged) {
            return;
        }

        $originalTerminalId = $user->getInitialValue('terminalId');
        if (!$originalTerminalId) {
            return;
        }

        $endpoint = $this->psEndpointRepository->findOneByTerminalId(
            (int) $originalTerminalId
        );

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
