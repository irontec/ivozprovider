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
    const VM_DUR        = 3;
    const VM_MSGNUM     = 4;
    const VM_CALLERID   = 5;
    const VM_CIDNAME    = 6;
    const VM_CIDNUM     = 7;
    const VM_DATE       = 8;
    const VM_MESSAGEFILE = 9;
    
    public function sendmailAction ()
    {
        try {
            // Get Raw mail content
            $handle = fopen("php://stdin", "r");
            // Load Email data
            $message = new Zend_Mail_Message(array('file' => $handle));
            
            // Get Voicemail data from body content
            $vmdata = explode(PHP_EOL, $message->getPart(1)->getContent());
           
            // Get Voicemail model 
            $vmMapper = new \IvozProvider\Mapper\Sql\AstVoicemail;
            $vm = $vmMapper->findOneByField("mailbox", $vmdata[self::VM_MAILBOX]);
            $user = $vm->getUser();
            
            $substitution = array(
                '${VM_CATEGORY}'    => $vmdata[self::VM_CATEGORY],
                '${VM_NAME}'        => $vmdata[self::VM_NAME],
                '${VM_MAILBOX}'     => $vmdata[self::VM_MAILBOX],
                '${VM_DUR}'         => $vmdata[self::VM_DUR],
                '${VM_MSGNUM}'      => $vmdata[self::VM_MSGNUM],
                '${VM_CALLERID}'    => $vmdata[self::VM_CALLERID],
                '${VM_CIDNAME}'     => $vmdata[self::VM_CIDNAME],
                '${VM_CIDNUM}'      => $vmdata[self::VM_CIDNUM],
                '${VM_DATE}'        => $vmdata[self::VM_DATE],
            );
            
            $templateDir = APPLICATION_PATH . "/../templates/voicemail/" . $user->getLanguageCode() . "/";
            
            $body = file_get_contents($templateDir . "body");
            $subject = file_get_contents($templateDir . "subject");
            
            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }
            
            $mail = new Zend_Mail('utf8');
            $mail->setBodyText($body);
            $mail->setSubject($subject);
            $mail->setFrom("IvozProvider");
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
