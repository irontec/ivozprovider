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

    public function execute(UserInterface $user)
    {
        $voicemail = $this->voicemailRepository->findOneByUserId(
            $user->getId()
        );

        $voicemailDto = is_null($voicemail)
            ? new VoicemailDto()
            : $voicemail->toDto();

        if ($user->getVoicemailSendMail()) {
            $voicemailDto->setEmail(
                $user->getEmail()
            );
        } else {
            $voicemailDto->setEmail(null);
        }

        if ($user->getVoicemailAttachSound()) {
            $voicemailDto->setAttach('yes');
        } else {
            $voicemailDto->setAttach('no');
        }

        // Update/Insert endpoint data
        $fullName = $user->getName() . " " . $user->getLastname();
        $voicemailDto
            ->setUserId($user->getId())
            ->setContext($user->getVoiceMailContext())
            ->setMailbox($user->getVoiceMailUser())
            ->setFullname($fullName)
            ->setTz($user->getTimezone()->getTz());

        $this->entityPersister->persistDto(
            $voicemailDto,
            $voicemail
        );
    }
}
