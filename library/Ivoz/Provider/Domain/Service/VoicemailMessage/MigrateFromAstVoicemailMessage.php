<?php

namespace Ivoz\Provider\Domain\Service\VoicemailMessage;

use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface as AstVoicemailMessageInterface;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository as AstVoicemailRepository;
use Ivoz\Ast\Domain\Service\VoicemailMessage\SetParsed;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Psr\Log\LoggerInterface;

class MigrateFromAstVoicemailMessage
{
    public function __construct(
        private CreateFromAstVoicemail $createFromAstVoicemail,
        private AstVoicemailRepository $astVoicemailRepository,
        private EntityTools $entityTools,
        private SetParsed $setParsed,
        private LoggerInterface $logger
    ) {
    }

    public function execute(AstVoicemailMessageInterface $astVoicemailMessage): void
    {
        $mailboxUser = $astVoicemailMessage->getMailboxuser();
        $mailboxContext = $astVoicemailMessage->getMailboxcontext();
        $hasMailbox = $mailboxUser && $mailboxContext;
        if (!$hasMailbox) {
            $this->skip($astVoicemailMessage);
            return;
        }

        $astVoicemail = $this->astVoicemailRepository->findByMailboxAndContext(
            $mailboxUser,
            $mailboxContext,
        );

        if (!$astVoicemail) {
            $this->skip($astVoicemailMessage);
            return;
        }

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

    private function skip(AstVoicemailMessageInterface $astVoicemailMessage): void
    {
        $this->logger->warning(sprintf(
            'Voicemail message #%d skipped: mailbox "%s@%s" not found',
            (int) $astVoicemailMessage->getId(),
            $astVoicemailMessage->getMailboxuser(),
            $astVoicemailMessage->getMailboxcontext(),
        ));

        $this->setParsed->execute(
            $astVoicemailMessage,
        );
    }
}
