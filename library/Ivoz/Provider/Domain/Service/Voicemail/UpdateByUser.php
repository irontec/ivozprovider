<?php

namespace Ivoz\Provider\Domain\Service\Voicemail;

use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_HIGH;

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
    public function execute(UserInterface $user)
    {
        $voicemail = $user->getVoicemail();

        /** @var VoicemailDto $voicemailDto */
        $voicemailDto = is_null($voicemail)
            ? new VoicemailDto()
            : $this->entityTools->entityToDto($voicemail);

        // User company
        $company = $user->getCompany();

        // Update/Insert voicemail data
        $voicemailDto
            ->setCompanyId($company->getId())
            ->setEmail($user->getEmail())
            ->setUserId($user->getId())
            ->setName($user->getFullName());

        /** @var VoicemailInterface $voicemail */
        $voicemail = $this->entityTools->persistDto(
            $voicemailDto,
            $voicemail
        );

        $user->setVoicemail($voicemail);
    }
}
