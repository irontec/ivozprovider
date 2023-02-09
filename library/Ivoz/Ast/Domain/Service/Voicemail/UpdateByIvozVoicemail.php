<?php

namespace Ivoz\Ast\Domain\Service\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface as IvozVoicemailInterface;
use Ivoz\Provider\Domain\Service\Voicemail\VoicemailLifecycleEventHandlerInterface;

class UpdateByIvozVoicemail implements VoicemailLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(IvozVoicemailInterface $ivozVoicemail)
    {
        /** @var Voicemail | null $voicemail */
        $voicemail = $ivozVoicemail->getAstVoicemail();

        /** @var VoicemailDto $voicemailDto */
        $voicemailDto = is_null($voicemail)
            ? new VoicemailDto()
            : $this->entityTools->entityToDto($voicemail);

        $company = $ivozVoicemail->getCompany();

        if ($ivozVoicemail->getAttachSound()) {
            $voicemailDto->setAttach('yes');
        } else {
            $voicemailDto->setAttach('no');
        }

        // Update/Insert voicemail data
        $voicemailDto
            ->setVoicemailId($ivozVoicemail->getId())
            ->setContext($ivozVoicemail->getContext())
            ->setMailbox($ivozVoicemail->getMailbox())
            ->setCallback($ivozVoicemail->getType())
            ->setFullname($ivozVoicemail->getName())
            ->setEmail($ivozVoicemail->getEmail())
            ->setTz($company->getDefaultTimezone()?->getTz());

        $this->entityTools->persistDto(
            $voicemailDto,
            $voicemail
        );
    }
}
