<?php

namespace Voicemail;

use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use PhpMimeMailParser\Parser;
use RouteHandlerAbstract;

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

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $fromAdress;

    /**
     * @var string
     */
    protected $templatesDir;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * Sender constructor.
     * @param EntityManagerInterface $em
     * @param Parser $parser
     * @param \Swift_Mailer $mailer
     * @param string $templatesDir
     * @param string $fromName
     * @param string $fromAdress
     */
    public function __construct(
        EntityManagerInterface $em,
        Parser $parser,
        \Swift_Mailer $mailer,
        string $templatesDir,
        string $fromName,
        string $fromAdress
    )
    {
        $this->em = $em;
        $this->parser = $parser;
        $this->mailer = $mailer;
        $this->templatesDir = $templatesDir;
        $this->fromName = $fromName;
        $this->fromAdress = $fromAdress;
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function process ()
    {

        // Load Email data
        $this->parser->setStream(fopen("php://stdin", "r"));

        // Get Voicemail data from body content
        $vmdata = explode(PHP_EOL, $this->parser->getMessageBody());

        /** @var \Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository $vmRepository */
        $vmRepository = $this->em->getRepository(Voicemail::class);

        /** @var \Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface $vm */
        $vm = $vmRepository->findOneBy([
            "mailbox" => $vmdata[self::VM_MAILBOX],
            "context" => $vmdata[self::VM_CONTEXT]
        ]);

        // No voicemail, this should not happen
        Assertion::notNull(
            $vm,
            sprintf("Unable to find voicemail for %s@%s",
                $vmdata[self::VM_MAILBOX],
                $vmdata[self::VM_CONTEXT])
        );

        /** @var \Ivoz\Provider\Domain\Model\User\UserInterface $user */
        $user = $vm->getUser();
        Assertion::notNull(
            $user,
            sprintf("Unable to find user for voicemail %s@%s",
                $vmdata[self::VM_MAILBOX],
                $vmdata[self::VM_CONTEXT])
        );

        // Assume user has company and brand
        $company = $user->getCompany();
        $brand = $company->getBrand();

        // Use Brand's configured From name or default
        $fromName = $brand->getFromName();
        if (!empty($fromName)) {
            $this->fromName = $fromName;
        }

        // Use Brand's configured From address or default
        $fromAddress = $brand->getFromAddress();
        if (!empty($fromAddress)) {
            $this->fromAdress = $fromAddress;
        }

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

        $templateDir = $this->templatesDir . "/voicemail/default/" . $user->getLanguageCode() . "/";
        $body = file_get_contents($templateDir . "body");
        $subject = file_get_contents($templateDir . "subject");

        foreach ($substitution as $search => $replace) {
            $body = str_replace($search, $replace, $body);
            $subject = str_replace($search, $replace, $subject);
        }

        // Create a new mail and attach the PDF file
        $mail = new \Swift_Message();
        $mail->setBody($body)
            ->setSubject($subject)
            ->setFrom($this->fromAdress, $this->fromName)
            ->setTo($vm->getEmail());

        /** @var \PhpMimeMailParser\Attachment[] $attachments */
        $attachments = $this->parser->getAttachments();
        foreach ($attachments as $attachment) {
            $wavContent = $attachment->getContent();
            $wavName = sprintf("msg%04d.wav", $vmdata[self::VM_MSGNUM]);
            $att = new \Swift_Attachment($wavContent, $wavName, "audio/x-wav");
            $att->setEncoder(new \Swift_Mime_ContentEncoder_Base64ContentEncoder());
            $mail->attach($att);
        }
        // Send the email
        $this->mailer->send($mail);
    }
}
