<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class UpdateByExtension
 * @package Ivoz\Ast\Domain\Service\PsEndpoint
 * @lifecycle pre_persist
 */
class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    /**
     * @param ExtensionInterface $extension
     *
     * @return void
     */
    public function execute(ExtensionInterface $extension)
    {
        // Ignore non-user extensions
        $user = $extension->getUser();
        if (!$user) {
            return;
        }

        // Only apply to user's with extension
        $userExtension = $user->getExtension();
        if (!$userExtension) {
            return;
        }

        // Only apply if the extension changed is user's screen extension
        if ($extension->getId() != $userExtension->getId()) {
            return;
        }

        // Ignore non-terminal users
        $terminal = $user->getTerminal();
        if (!$terminal) {
            return;
        }

        // Update terminal endpoint
        $endpoint = $terminal->getPsEndpoint();
        if (!$endpoint) {
            return;
        }
        /** @var PsEndpointDto $endpointDto */
        $endpointDto = $this->entityTools->entityToDto($endpoint);

        $callerId = sprintf(
            '%s <%s>',
            $user->getFullName(),
            $user->getExtensionNumber()
        );

        // Set new callerid with updated extension number
        $endpointDto->setCallerid($callerId);

        // Update user voicemail
        $voicemail = $user->getVoicemail();

        // Update endpoint voicemail mailbox@context
        if ($voicemail) {
            $endpointDto->setMailboxes($voicemail->getVoicemailName());
        }

        // Update endpoint pickup groups
        $endpointDto->setNamedPickupGroup($user->getPickUpGroupsIds());

        $this->entityTools->persistDto(
            $endpointDto,
            $endpoint
        );
    }
}
