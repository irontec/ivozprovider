<?php

namespace Ivoz\Ast\Domain\Service\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

/**
 * Class UpdateByExtension
 * @package Ivoz\Ast\Domain\Service\Voicemail
 * @lifecycle pre_persist
 */
class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var VoicemailRepository
     */
    protected $voicemailRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        VoicemailRepository $voicemailRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->voicemailRepository = $voicemailRepository;
    }

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

        // Only apply to users with voicemail enabled
        /** @var VoicemailInterface $voicemail */
        $voicemail = $this->voicemailRepository->findOneBy([
            'user' => $user->getId()
        ]);

        if (!$voicemail) {
            return;
        }

        /** @var VoicemailDto $voicemailDTO */
        $voicemailDTO = $voicemail->toDto();
        $voicemailDTO
            ->setContext($user->getVoiceMailContext())
            ->setMailbox($user->getVoiceMailUser());

        $this->entityPersister->persistDto(
            $voicemailDTO,
            $voicemail
        );
    }
}