<?php

namespace spec\Ivoz\Provider\Domain\Service\VoicemailMessage;

use Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface as AstVoicemailInterface;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository as AstVoicemailRepository;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface as AstVoicemailMessageInterface;
use Ivoz\Ast\Domain\Service\VoicemailMessage\SetParsed;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;
use Ivoz\Provider\Domain\Service\VoicemailMessage\CreateFromAstVoicemail;
use Ivoz\Provider\Domain\Service\VoicemailMessage\MigrateFromAstVoicemailMessage;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class MigrateFromAstVoicemailMessageSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $createFromAstVoicemail;
    protected $astVoicemailRepository;
    protected $entityTools;
    protected $setParsed;
    protected $logger;

    public function let(
        CreateFromAstVoicemail $createFromAstVoicemail,
        AstVoicemailRepository $astVoicemailRepository,
        EntityTools $entityTools,
        SetParsed $setParsed,
        LoggerInterface $logger
    ) {
        $this->createFromAstVoicemail = $createFromAstVoicemail;
        $this->astVoicemailRepository = $astVoicemailRepository;
        $this->entityTools = $entityTools;
        $this->setParsed = $setParsed;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->createFromAstVoicemail,
            $this->astVoicemailRepository,
            $this->entityTools,
            $this->setParsed,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MigrateFromAstVoicemailMessage::class);
    }

    function it_migrates_messages_of_existing_mailboxes(
        AstVoicemailMessageInterface $astVoicemailMessage,
        AstVoicemailInterface $astVoicemail,
        VoicemailInterface $voicemail,
        VoicemailMessageInterface $voicemailMessage
    ) {
        $this->prepareMessage($astVoicemailMessage, 'user1', 'company1');

        $this
            ->astVoicemailRepository
            ->findByMailboxAndContext('user1', 'company1')
            ->willReturn($astVoicemail);

        $astVoicemail
            ->getVoicemail()
            ->willReturn($voicemail);

        $this
            ->createFromAstVoicemail
            ->execute($astVoicemailMessage, $voicemail)
            ->shouldBeCalled()
            ->willReturn($voicemailMessage);

        $this
            ->entityTools
            ->persist($voicemailMessage)
            ->shouldBeCalled();

        $this
            ->setParsed
            ->execute($astVoicemailMessage)
            ->shouldBeCalled();

        $this->execute($astVoicemailMessage);
    }

    function it_marks_as_parsed_messages_whose_mailbox_no_longer_exists(
        AstVoicemailMessageInterface $astVoicemailMessage
    ) {
        $this->prepareMessage($astVoicemailMessage, 'user99', 'company1');

        $this
            ->astVoicemailRepository
            ->findByMailboxAndContext('user99', 'company1')
            ->willReturn(null);

        $this->expectSkippedMessage($astVoicemailMessage);

        $this->execute($astVoicemailMessage);
    }

    function it_marks_as_parsed_messages_without_mailbox(
        AstVoicemailMessageInterface $astVoicemailMessage
    ) {
        $this->prepareMessage($astVoicemailMessage, '', 'company1');

        $this
            ->astVoicemailRepository
            ->findByMailboxAndContext(Argument::cetera())
            ->shouldNotBeCalled();

        $this->expectSkippedMessage($astVoicemailMessage);

        $this->execute($astVoicemailMessage);
    }

    private function prepareMessage(
        $astVoicemailMessage,
        string $mailboxUser,
        string $mailboxContext
    ): void {
        $this->getterProphecy(
            $astVoicemailMessage,
            [
                'getId' => 1,
                'getMailboxuser' => $mailboxUser,
                'getMailboxcontext' => $mailboxContext,
            ],
            false
        );
    }

    private function expectSkippedMessage($astVoicemailMessage): void
    {
        $this
            ->logger
            ->warning(Argument::type('string'))
            ->shouldBeCalled();

        $this
            ->createFromAstVoicemail
            ->execute(Argument::cetera())
            ->shouldNotBeCalled();

        $this
            ->setParsed
            ->execute($astVoicemailMessage)
            ->shouldBeCalled();
    }
}
