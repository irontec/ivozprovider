<?php

/**
 * @brief Dynamic VoiceMail notifications
 *
 * This controller will be invoked to generate voicemail notifications
 *
 * @package AGI
 * @subpackage VoiceMailController
 * @author Gaizka Elexpe <gelexpe@irontec.com>
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class VoicemailController extends Zend_Controller_Action
{

    const VM_CATEGORY   = 0;
    const VM_NAME       = 1;
    const VM_MAILBOX    = 2;
    const VM_CONTEXT    = 3;
    const VM_DUR        = 4;
    const VM_MSGNUM     = 5;
    const VM_CALLERID   = 6;
    const VM_CIDNAME    = 7;
    const VM_CIDNUM     = 8;
    const VM_DATE       = 9;
    const VM_MESSAGEFILE = 10;

    public function sendmailAction ()
    {

        try {
            // Get defaults mail settings
            $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
            $mail = $config->getOption('mail');
            $default_fromname = $mail['fromname'];
            $default_fromuser = $mail['fromuser'];
            $voicemail = $config->getOption('voicemail');
            $template = $voicemail['template'];

            // Get Raw mail content
            $handle = fopen("php://stdin", "r");
            // Load Email data
            $message = new Zend_Mail_Message(array('file' => $handle));

            // Get Voicemail data from body content
            $vmdata = explode(PHP_EOL, $message->getPart(1)->getContent());

            // Get Voicemail model
            $vmMapper = new \IvozProvider\Mapper\Sql\AstVoicemail;
            $whereCond = array(
                "mailbox = '" . $vmdata[self::VM_MAILBOX] . "'",
                "context = '" . $vmdata[self::VM_CONTEXT] . "'"
            );

            // Search the destination user of this Voicemail
            $vm = $vmMapper->fetchOne(implode(' AND ', $whereCond));

            // No voicemail, this should not happen
            if (empty($vm)) {
                die("FATAL: Unable to find voicemail for " .
                     $vmdata[self::VM_MAILBOX] . '@' . $vmdata[self::VM_CONTEXT]);
            }

            // Get Voicemail User
            $user = $vm->getUser();
            if (empty($user)) {
                die("FATAL: Unable to find user for voicemail " .
                     $vmdata[self::VM_MAILBOX] . '@' . $vmdata[self::VM_CONTEXT]);
            }

            // Assume user has company and brand
            $company = $user->getCompany();
            $brand = $company->getBrand();

            // Use Brand's configured From name or default
            $fromName = $brand->getFromName();
            if (empty($fromName)) {
                $fromName = $default_fromname;
            }

            // Use Brand's configured From address or default
            $fromAddress = $brand->getFromAddress();
            if (empty($fromAddress)) {
                $fromAddress = $default_fromuser;
            }

            $substitution = array(
                '${VM_CATEGORY}'    => $vmdata[self::VM_CATEGORY],
                '${VM_NAME}'        => $vmdata[self::VM_NAME],
                '${VM_MAILBOX}'     => $vmdata[self::VM_MAILBOX],
                '${VM_CONTEXT}'     => $vmdata[self::VM_CONTEXT],
                '${VM_DUR}'         => $vmdata[self::VM_DUR],
                '${VM_MSGNUM}'      => $vmdata[self::VM_MSGNUM],
                '${VM_CALLERID}'    => $vmdata[self::VM_CALLERID],
                '${VM_CIDNAME}'     => $vmdata[self::VM_CIDNAME],
                '${VM_CIDNUM}'      => $vmdata[self::VM_CIDNUM],
                '${VM_DATE}'        => $vmdata[self::VM_DATE],
            );

            $templateDir = APPLICATION_PATH . "/../templates/voicemail/brand" . $brand->getId() . "/" . $user->getLanguageCode();
            if (!is_dir($templateDir)) {
                $templateDir = APPLICATION_PATH . "/../templates/voicemail/$template/" . $user->getLanguageCode();
            }

            $body = file_get_contents($templateDir . "/body");
            $subject = file_get_contents($templateDir . "/subject");

            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }

            $mail = new Zend_Mail('UTF-8');
            $mail->setBodyText($body);
            $mail->setSubject($subject);
            $mail->setFrom($fromAddress, $fromName);
            $mail->addTo($vm->getEmail());

            if ($message->countParts() == 2 )
            {
                $wav = base64_decode($message->getPart(2)->getContent());
                $att = new Zend_Mime_Part($wav);
                $att->type          = "audio/x-wav";
                $att->disposition   = Zend_Mime::DISPOSITION_ATTACHMENT;
                $att->encoding      = Zend_Mime::ENCODING_BASE64;
                $att->filename      = sprintf("msg%04d.wav", $vmdata[self::VM_MSGNUM]);
                $mail->addAttachment($att);
            }

            $mail->send();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
