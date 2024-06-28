<?php

namespace Ivoz\Provider\Domain\Service\VoicemailRelUser;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUser;
use Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity\AvoidUpdates;

use function PHPUnit\Framework\assertEquals;

class CheckGenericVoicemail implements VoicemailRelUserLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(VoicemailRelUser $voicemailRelUser): void
    {
        $voicemail = $voicemailRelUser->getVoicemail();

        if ($voicemail->getUser() === null) {
            return;
        }

        throw new \DomainException(
            'Can not associate user with a non-generic voice mail',
            400
        );
    }
}
