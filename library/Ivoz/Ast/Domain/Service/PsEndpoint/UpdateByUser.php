<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUser implements UserLifecycleEventHandlerInterface
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
            self::EVENT_POST_PERSIST => 40
        ];
    }

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

        $callerId = sprintf(
            '%s <%s>',
            $user->getFullName(),
            $user->getExtensionNumber()
        );

        $endpointDto
            ->setCallerid($callerId)
            ->setMailboxes($user->getVoiceMail());

        $this
            ->entityTools
            ->persistDto($endpointDto, $endpoint, false);
    }
}
