<?php

namespace Ivoz\Ast\Domain\Service\VoicemailMessage;

use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface;
use Ivoz\Ast\Infrastructure\Asterisk\AMI\AMIConnector;
use Ivoz\Ast\Domain\Service\VoicemailMessage\VoicemailMessageLifecycleEventHandlerInterface;

class SendVoicemailRefresh implements VoicemailMessageLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private AMIConnector $amiConnector,
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(VoicemailMessageInterface $voicemailMessage): void
    {
        if (!$voicemailMessage->hasBeenDeleted()) {
            return;
        }

        $mailbox = $voicemailMessage->getMailbox();

        $this
            ->amiConnector
            ->mailboxRefresh($mailbox);
    }
}
