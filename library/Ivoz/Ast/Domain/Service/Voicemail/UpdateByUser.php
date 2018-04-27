<?php

namespace Ivoz\Ast\Domain\Service\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUser implements UserLifecycleEventHandlerInterface
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

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(UserInterface $entity, $isNew)
    {
        $voicemail = $this->voicemailRepository->findOneBy([
            'user' => $entity->getId()
        ]);

        $voicemailDTO = is_null($voicemail)
            ? new VoicemailDto()
            : $voicemail->toDto();

        if ($entity->getVoicemailSendMail()) {
            $voicemailDTO->setEmail(
                $entity->getEmail()
            );
        } else {
            $voicemailDTO->setEmail(null);
        }

        if ($entity->getVoicemailAttachSound()) {
            $voicemailDTO->setAttach('yes');
        } else {
            $voicemailDTO->setAttach('no');
        }

        // Update/Insert endpoint data
        $fullName = $entity->getName() . " " . $entity->getLastname();
        $voicemailDTO
            ->setUserId($entity->getId())
            ->setContext($entity->getVoiceMailContext())
            ->setMailbox($entity->getVoiceMailUser())
            ->setFullname($fullName)
            ->setTz($entity->getTimezone()->getTz());

        $this->entityPersister->persistDto(
            $voicemailDTO,
            $voicemail
        );
    }
}