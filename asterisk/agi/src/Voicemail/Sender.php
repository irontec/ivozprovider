<?php

namespace Voicemail;

use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository;
use Ivoz\Core\Domain\Model\Mailer\Attachment;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use PhpMimeMailParser\Parser;
use Psr\Log\LoggerInterface;
use RouteHandlerAbstract;
use Symfony\Component\Mailer\MailerInterface;

class Sender extends RouteHandlerAbstract
{
    const VM_CATEGORY    = 0;
    const VM_NAME        = 1;
    const VM_MAILBOX     = 2;
    const VM_CONTEXT     = 3;
    const VM_DUR         = 4;
    const VM_MSGNUM      = 5;
    const VM_CALLERID    = 6;
    const VM_CIDNAME     = 7;
    const VM_CIDNUM      = 8;
    const VM_DATE        = 9;
    const VM_MESSAGEFILE = 10;

    public function __construct(
        private EntityManagerInterface $em,
        private Parser $parser,
        private MailerInterface $mailer,
        private LoggerInterface $logger,
        private string $localStoragePath,
    ) {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function process()
    {
        // Load Email data
        $this->parser->setStream(fopen("php://stdin", "r"));

        // Get Voicemail data from body content
        $vmdata = explode(PHP_EOL, $this->parser->getMessageBody());

        /** @var VoicemailRepository $astVoicemailRepository */
        $astVoicemailRepository = $this->em->getRepository(Voicemail::class);

        // Find associated asterisk voicemail
        $astVoicemail = $astVoicemailRepository->findByMailboxAndContext(
            $vmdata[self::VM_MAILBOX],
            $vmdata[self::VM_CONTEXT]
        );

        // No voicemail, this should not happen
        Assertion::notNull(
            $astVoicemail,
            sprintf(
                "Unable to find astVoicemail for %s@%s",
                $vmdata[self::VM_MAILBOX],
                $vmdata[self::VM_CONTEXT]
            )
        );

        // Get provider voicemail
        $voicemail = $astVoicemail->getVoicemail();

        // No voicemail, this should not happen
        Assertion::notNull(
            $voicemail,
            sprintf(
                "Unable to find voicemail for %s@%s",
                $vmdata[self::VM_MAILBOX],
                $vmdata[self::VM_CONTEXT]
            )
        );

        // Get voicemail company
        $company = $voicemail->getCompany();

        $substitution = array(
            '${VM_CATEGORY}' => $vmdata[self::VM_CATEGORY],
            '${VM_NAME}' => $vmdata[self::VM_NAME],
            '${VM_MAILBOX}' => $vmdata[self::VM_MAILBOX],
            '${VM_CONTEXT}' => $vmdata[self::VM_CONTEXT],
            '${VM_DUR}' => $vmdata[self::VM_DUR],
            '${VM_MSGNUM}' => $vmdata[self::VM_MSGNUM],
            '${VM_CALLERID}' => $vmdata[self::VM_CALLERID],
            '${VM_CIDNAME}' => $vmdata[self::VM_CIDNAME],
            '${VM_CIDNUM}' => $vmdata[self::VM_CIDNUM],
            '${VM_DATE}' => $vmdata[self::VM_DATE],
        );

        // Get Generic Notification Template for voicemails
        /** @var NotificationTemplateRepository $notificationTemplateRepository */
        $notificationTemplateRepository = $this->em->getRepository(NotificationTemplate::class);
        $vmNotificationTemplate = $notificationTemplateRepository->findVoicemailTemplateByCompany(
            $company,
            $voicemail->getLanguage()
        );

        // Get Notification contents for required language
        $notificationTemplateContent = $vmNotificationTemplate->getContentsByLanguage(
            $voicemail->getLanguage()
        );

        // Get data from template
        $fromName = $notificationTemplateContent->getFromName();
        $fromAddress = $notificationTemplateContent->getFromAddress();
        $bodyType = $notificationTemplateContent->getBodyType();
        $body = $notificationTemplateContent->getBody();
        $subject = $notificationTemplateContent->getSubject();
        $toAddress = $voicemail->getEmail();

        foreach ($substitution as $search => $replace) {
            $body = str_replace($search, $replace, $body);
            $subject = str_replace($search, $replace, $subject);
        }

        $this->logger->info(
            "Preparing email to " . $toAddress
        );

        // Create a new mail and attach the PDF file
        $message = new Message();
        $message->setBody($body, $bodyType)
            ->setSubject($subject)
            ->setFromAddress((string) $fromAddress)
            ->setFromName((string) $fromName)
            ->setToAddress((string) $toAddress);

        $attachments = $this->parser->getAttachments();
        foreach ($attachments as $attachment) {
            $wavName = sprintf("msg%04d.wav", (int) $vmdata[self::VM_MSGNUM] - 1);
            $wavFilePath = sprintf(
                "%s/%s/%s/INBOX/%s",
                $this->localStoragePath,
                $vmdata[self::VM_CONTEXT],
                $vmdata[self::VM_MAILBOX],
                $wavName,
            );

            $message->addAttachment(
                $wavFilePath,
                $wavName,
                "audio/x-wav"
            );
        }

        // Send the email
        $this->mailer->send(
            $message->toEmail()
        );

        $this->logger->info(
            "Voicemail sent to " . $toAddress
        );
    }
}
