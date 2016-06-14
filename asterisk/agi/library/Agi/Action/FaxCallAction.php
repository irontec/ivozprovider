<?php
namespace Agi\Action;

use IvozProvider\Model as Model;
use IvozProvider\Mapper\Sql as Mapper;

class FaxCallAction extends RouterAction
{
    protected $_timeout;

    protected $_dialStatus = null;

    protected $_dialContext = 'fax-in';

    protected $_fax = null;

    protected $_faxInOut = null;

    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
        return $this;
    }

    public function setDialContext($context)
    {
        $this->_dialContext = $context;
        return $this;
    }


	public function getDialStatus()
	{
	    return $this->_dialStatus;
	}

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
            $this->_dialStatus = "INVALIDARGS";
            $this->processFaxInStatus();
            return;
        }

        // Local variables to improve readability
  	    $fax = $this->_fax;

        // This fax routed from DDI
        $did = $this->agi->getExtension();

        // Fax location is lbased on asterisk configuration
        $faxdir = $this->agi->getVariable(
                        "AST_CONFIG(asterisk.conf,directories,astspooldir)");

        // Set destination file an fax options
        $this->agi->setVariable("FAXFILE",
                        $faxdir . "/faxes/fax-" . $did . "-" . time() . ".tif");
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
        $this->agi->setVariable("FAXIN_ID", $faxIn->getId());

        // Some verbose dolan pls
        $this->agi->notice("Incoming fax from %d did. Preparing fax to send to %s)",
                   $did,$fax->getName());

        // Transform number to Company Preferred
        // This transformation will be overriden if this calls ends in an User
        $preferred = $fax->getCompany()->E164ToPreferred($this->agi->getOrigCallerIdNum());
        $this->agi->setCallerIdNum($preferred);

        // Set recive fax options
        $this->agi->setVariable("FAX_OPT","f");

        // Redirect to the calling dialplan context
        if ($this->_dialContext) {
            $this->agi->redirect($this->_dialContext, $did);
        }
    }

    public function sendFax()
    {
        if (empty($this->_fax) || empty($this->_faxInOut)) {
            $this->agi->error("fax is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $fax = $this->_fax;
        $faxOut = $this->_faxInOut;

        // Prepare to call destination
        $DDIOut = $fax->getOutgoingDDI();

        // Fax without assigned DDIout
        if (! $DDIOut) {
            $this->agi->error("Fax " . $fax->getId() . "does not have DDIOut");
            $faxOut->setStats("error")->save();
            $this->agi->hangup();
            return;
        }

        // Set headers to place the outgoing call
        $this->agi->setVariable("CALLERID(num)", $DDIOut->getDDIE164());
        $this->agi->setVariable("CALLERID(name)", $fax->getName());

        $faxOut->setStatus("inprogress")->save();

        // Set recive fax options
        $this->agi->setVariable("FAX_OPT","f");

        // Normalize called number to E164
        $number = $fax->getCompany()->preferredToE164($this->agi->getExtension());

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", "");

    }

    public function processFaxInStatus()
    {

        if (empty($this->_fax) || empty($this->_faxInOut)) {
            $this->agi->error("fax is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $fax = $this->_fax;
        $faxIn = $this->_faxInOut;

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
        // Convert TIF file to PDF before storing
        $output = shell_exec("/usr/bin/tiff2pdf -o $faxPDF $faxTIF 2>/dev/null");

        // TODO Check return value for errors (use exec instead of shell_exec?)
        // Remove received tif file after conversion
        unlink($faxTIF);
        // Check if this fax is associated with an email address
        if ($fax->getSendByEmail()) {
            $this->agi->verbose("Sending Fax [faxInOut%d] to %s", $faxIn->getId(), $fax->getEmail());

            // Get faxdata values for mail message body and subject
            $faxSrc = $faxIn->getSrc();
            $faxDst = $faxIn->getDst();

            // Create attachment for PDF file
            $attach = new \Zend_Mime_Part(file_get_contents($faxPDF));
            $attach->type = "application/pdf";
            $attach->disposition = \Zend_Mime::DISPOSITION_ATTACHMENT;
            $attach->encoding = \Zend_Mime::ENCODING_BASE64;
            $attach->filename = "fax-$faxSrc-$faxDst.pdf";

            // Create an email for destination and send it
            $this->_faxSendMail($fax->getEmail(),
                "New fax received in $faxDst from $faxSrc",
                "New fax received in $faxDst.\nSee attached PDF file.",
                $attach);
        }

        // Store fax pages
        $faxIn->setPages($this->agi->getVariable("FAXOPT(pages)"));
        // Store FSO for this fax
        $faxIn->putFile($faxPDF);
        // Success!!
        $faxIn->setStatus('completed')->save();
        $this->agi->verbose("Fax [faxInOut%d] completed (%d pages)", $faxIn->getId(), $faxIn->getPages());
    }

    public function processleg0FaxOutStatus()
    {

        if (empty($this->_fax) || empty($this->_faxInOut)) {
            $this->agi->error("fax is not properly defined. Check configuration.");
            return;
        }
        // Local variables to improve readability
        $fax = $this->_fax;
        $faxOut = $this->_faxInOut;
        $this->agi->verbose("Fax leg0 dial status %s", $this->agi->getVariable("DIALSTATUS"));

        // Store fax pages
        if ($this->agi->getVariable("DIALSTATUS") != "ANSWER"){
            // Mark as success and save
            $faxOut->setStatus('error')->save();
            if ($fax->getSendByEmail()) {
                $this->agi->verbose("Sending Fax [faxInOut%d] to %s", $faxOut->getId(), $fax->getEmail());

                // Create an email for destination and send it
                $faxDst = $faxOut->getDst();
                $this->_faxSendMail($fax->getEmail(), "Fax sent to $faxDst", "Sending Fax to $faxDst FAILED.\n");
            }
        }
    }
    public function processleg1FaxOutStatus()
    {

        if (empty($this->_fax) || empty($this->_faxInOut)) {
            $this->agi->error("fax is not properly defined. Check configuration.");
            return;
        }
        // Local variables to improve readability
        $fax = $this->_fax;
        $faxOut = $this->_faxInOut;

        // Check no errors happened during ReceiveFax
        $error = $this->agi->getVariable("FAXOPT(error)");
        $statusstr = $this->agi->getVariable("FAXOPT(statusstr)");
        if (! empty($error) && $statusstr != "OK") {
            // Show error message in asterisk CLI
            $this->agi->error("Error sending fax: $statusstr ($error)");
            // Mark this fax as error and save
            $faxOut->setStatus('error')->save();
            if ($fax->getSendByEmail()) {
                $this->agi->verbose("Sending Fax [faxInOut%d] to %s", $faxOut->getId(), $fax->getEmail());

                // Create an email for destination and send it
                $faxDst = $faxOut->getDst();
                $this->_faxSendMail($fax->getEmail(), "Fax sent to $faxDst", "Sending Fax to $faxDst FAILED.\n");
            }
            return;
        }
        // Store fax pages
        $faxOut->setPages($this->agi->getVariable("FAXOPT(pages)"));
        // Mark as success and save
        $faxOut->setStatus('completed')->save();
        // Send mail with status SENT
        if ($fax->getSendByEmail()) {
            $this->agi->verbose("Sending Fax [faxInOut%d] to %s", $faxOut->getId(), $fax->getEmail());

            // Create an email for destination and send it
            $faxDst = $faxOut->getDst();
            $this->_faxSendMail($fax->getEmail(), "Fax sent to $faxDst", "Fax Sent to $faxDst.\n");

        }

    }

    private function _faxSendMail($toEmail, $subject, $body, $attach = null)
    {
        // Create an email for destination and send it
        $mail = new \Zend_Mail();
        if (!is_null($attach)){
            $mail->addAttachment($attach);
        }
        $mail->setBodyText($body)
             ->setFrom("IvozProvider")
             ->addTo($toEmail)
             ->setSubject($subject)
             ->send();
    }
}
