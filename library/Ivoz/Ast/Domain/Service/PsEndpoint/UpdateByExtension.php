<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class UpdateByExtension
 * @package Ivoz\Ast\Domain\Service\PsEndpoint
 * @lifecycle pre_persist
 */
class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
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
            self::EVENT_POST_PERSIST => 20
        ];
    }

    /**
     * @param ExtensionInterface $entity
     * @param $isNew
     */
    public function execute(ExtensionInterface $entity, $isNew)
    {
        // Ignore non-user extensions
        $user = $entity->getUser();
        if (!$user) {
            return;
        }

        // Only apply to user's with extension
        $extension = $user->getExtension();
        if (!$extension) {
            return;
        }

        // Only apply if the extension changed is user's screen extension
        if ($entity->getId() != $extension->getId()) {
            return;
        }

        // Ignore non-terminal users
        $terminal = $user->getTerminal();
        if (!$terminal) {
            return;
        }

        // Update terminal endpoint
        /** @var PsEndpointInterface $endpoint */
        $endpoint = $terminal->getAstPsEndpoint();
        if (!$endpoint) {
            return;
        }

        $callerId = sprintf(
            '%s <%s>',
            $user->getFullName(),
            $user->getExtensionNumber()
        );

        // Set new callerid with updated extension number
        $endpoint->setCallerid($callerId);

        // Update endpoint voicemail mailbox@context
        if ($user->getVoicemailEnabled()) {
            $endpoint->setMailboxes($user->getVoiceMail());
        }

        $this
            ->entityPersister
            ->persist($endpoint);
    }
}