<?php
namespace Agi\Action;

use IvozProvider\Model as Model;

class FaxCallAction extends RouterAction
{
    protected $_fax = null;

    protected $_faxInOut = null;

    public function setFax($fax)
    {
        $this->_fax = $fax;
        return $this;
    }

    public function setFaxInOut($faxInOut)
    {
        $this->_faxInOut = $faxInOut;
        return $this;
    }

    public function reciveFax()
    {
        if (empty($this->_fax)) {
            $this->agi->error("fax is not properly defined. Check configuration.");
            $this->processFaxInStatus();
            return;
        }

        // Local variables to improve readability
        $fax = $this->_fax;

        // This fax routed from DDI
        $did = $this->agi->getExtension();

        // Fax location is lbased on asterisk configuration
        $spoolDir = $this->agi->getVariable("AST_CONFIG(asterisk.conf,directories,astspooldir)");

        // Set destination file and fax options
        $faxDir = $spoolDir . "/faxes";
        if(!is_dir($faxDir)){
            mkdir($faxDir,0777);
        }

        $this->agi->setVariable("FAXFILE", $spoolDir . "/faxes/fax-" . $did . "-" . time() . ".tif");
        $this->agi->setVariable("FAXOPT(headerinfo)", $fax->getName());
        $this->agi->setVariable("FAXOPT(localstationid)", $did);

        // Create a new items for received fax data
        $faxIn = new Model\FaxesInOut();
        $faxIn->setFaxId($fax->getId())
            ->setSrc($this->agi->getVariable("CALLERID(number)"))
            ->setDst($did)
            ->setType("In")
            ->setStatus("inprogress")
            ->save();

        // Store FaxId for later searchs
        $this->agi->setVariable("FAXFILE_ID", $faxIn->getId());

        // Some verbose dolan pls
        $this->agi->notice("Incoming fax for %s [fax%d])", $fax->getName(), $fax->getId());

        // Transform number to Company Preferred
        $preferred = $fax->getCompany()->E164ToPreferred($this->agi->getOrigCallerIdNum());
        $this->agi->setCallerIdNum($preferred);

        // Set recive fax options
        $this->agi->setVariable("FAX_OPT","zf");

        // Redirect to the calling dialplan context
        $this->agi->redirect('fax-receive', $did);
    }

    public function processStatus()
    {
        if (empty($this->_faxInOut)) {
            $this->agi->error("No Faxfile found! Check configuration.");
            return;
        }

        // Local variables to improve readability
        $faxIn = $this->_faxInOut;
        $fax = $faxIn->getFax();

        // Check no errors happened during ReceiveFax
        $error = $this->agi->getVariable("FAXOPT(error)");
        $statusstr = $this->agi->getVariable("FAXOPT(statusstr)");
        if (! empty($error) && $statusstr != "OK") {
            // Show error message in asterisk CLI
            $this->agi->error("Error receiving fax: $statusstr ($error)");
            // Mark this fax as error and save
            $faxIn->setStatus('error')->save();
            return;
        }

        // Get final PDF name
        $faxTIF = $this->agi->getVariable("FAXOPT(filename)");
        $faxPDF = str_replace(".tif", ".pdf", $faxTIF);
        if (! file_exists($faxTIF)) {
            // Show error message in asterisk CLI
            $this->agi->error("File $faxTIF does not exists.");
            // Mark this fax as error and save
            $faxIn->setStatus('error')->save();
            return;
        }

        // Some asterisk cli output
        $this->agi->verbose("Converting Fax [faxInOut%d] [fax%d] TIFF to PDF", $faxIn->getId(), $fax->getId());
        // Convert TIFF file to PDF before storing
        $output = shell_exec("/usr/bin/tiff2pdf -o $faxPDF $faxTIF 2>/dev/null");

        // TODO Check return value for errors (use exec instead of shell_exec?)
        // Remove received tif file after conversion
        unlink($faxTIF);

        // Store fax pages
        $faxIn->setPages($this->agi->getVariable("FAXOPT(pages)"));

        // Check if this fax is associated with an email address
        if ($fax->getSendByEmail()) {
            $this->agi->notice("Sending Fax [faxInOut%d] to %s", $faxIn->getId(), $fax->getEmail());

            // Get Fax Company
            $company = $fax->getCompany();

            // Get defaults mail settings
            $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
            $mail = $config->getOption('mail');
            $default_fromname = $mail['fromname'];
            $default_fromuser = $mail['fromuser'];
            $voicemail = $config->getOption('faxmail');
            $template = $voicemail['template'];

            // Create attachment for PDF file
            $pdfname = sprintf("fax-%s-%s.pdf", $faxIn->getSrc(), $faxIn->getDst());
            $attach = new \Zend_Mime_Part(file_get_contents($faxPDF));
            $attach->type = "application/pdf";
            $attach->disposition = \Zend_Mime::DISPOSITION_ATTACHMENT;
            $attach->encoding = \Zend_Mime::ENCODING_BASE64;
            $attach->filename = $pdfname;

            $fromName = $company->getBrand()->getFromName();
            if (empty($fromName)) {
                $fromName = $default_fromname;
            }
            $fromAddress = $company->getBrand()->getFromAddress();
            if (empty($fromAddress)) {
                $fromAddress = $default_fromuser;
            }

            // Get faxdata values for mail message body and subject
            $substitution = array(
                    '${FAX_NAME}'       => $fax->getName(),
                    '${FAX_PDFNAME}'    => $pdfname,
                    '${FAX_SRC}'        => $faxIn->getSrc(),
                    '${FAX_DST}'        => $faxIn->getDst(),
                    '${FAX_DATE}'       => $faxIn->getCalldate(),
                    '${FAX_PAGES}'      => $faxIn->getPages(),
            );

            $templateDir = APPLICATION_PATH . "/../templates/faxmail/brand" . $company->getBrandId() . "/" . $company->getLanguageCode();
            if (!is_dir($templateDir)) {
                $templateDir = APPLICATION_PATH . "/../templates/faxmail/$template/" . $company->getLanguageCode();
            }

            $body = file_get_contents($templateDir . "/body");
            $subject = file_get_contents($templateDir . "/subject");

            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }

            $mail = new \Zend_Mail('UTF-8');
            $mail->setBodyText($body);
            $mail->setSubject($subject);
            $mail->setFrom($fromAddress, $fromName);
            $mail->addTo($fax->getEmail());
            $mail->addAttachment($attach);
            $mail->send();
        }

        // Store FSO for this fax
        $faxIn->putFile($faxPDF);
        // Success!!
        $faxIn->setStatus('completed')->save();
        $this->agi->verbose("Fax [faxInOut%d] completed (%d pages)", $faxIn->getId(), $faxIn->getPages());
    }
}
