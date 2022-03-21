<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 40
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

        $voicemail = $user->getVoicemail();
        $mailbox = $voicemail
            ? $voicemail->getVoicemailName()
            : null;

        $callerId = sprintf(
            '%s <%s>',
            $user->getFullName(),
            $user->getExtensionNumber()
        );

        $endpointDto
            ->setCallerid($callerId)
            ->setMailboxes($mailbox)
            ->setNamedPickupGroup($user->getPickUpGroupsIds());

        $this
            ->entityTools
            ->persistDto($endpointDto, $endpoint, false);
    }
}
