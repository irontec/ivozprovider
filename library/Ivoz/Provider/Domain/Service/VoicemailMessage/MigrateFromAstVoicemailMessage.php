<?php

namespace Ivoz\Provider\Domain\Service\VoicemailMessage;

use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface as AstVoicemailMessageInterface;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository as AstVoicemailRepository;
use Ivoz\Ast\Domain\Service\VoicemailMessage\SetParsed;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;

class MigrateFromAstVoicemailMessage
{
    public function __construct(
        private CreateFromAstVoicemail $createFromAstVoicemail,
        private AstVoicemailRepository $astVoicemailRepository,
        private EntityTools $entityTools,
        private SetParsed $setParsed
    ) {
    }

    public function execute(AstVoicemailMessageInterface $astVoicemailMessage): void
    {
        $mailboxUser = $astVoicemailMessage->getMailboxuser();
        $mailboxContext = $astVoicemailMessage->getMailboxcontext();
        if (!$mailboxUser || !$mailboxContext) {
            return;
        }

        $astVoicemail = $this->astVoicemailRepository->findByMailboxAndContext(
            $mailboxUser,
            $mailboxContext,
        );

        /** @var VoicemailInterface $voicemail */
        $voicemail = $astVoicemail->getVoicemail();

        $voicemailMessage = $this
            ->createFromAstVoicemail
            ->execute(
                $astVoicemailMessage,
                $voicemail,
            );

        $this->entityTools->persist(
            $voicemailMessage,
        );

        $this->setParsed->execute(
            $astVoicemailMessage,
        );
    }
}
