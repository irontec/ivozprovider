<?php
require_once ("BaseController.php");
use IvozProvider\Mapper\Sql as Mapper;
use IvozProvider\Model as Model;

/**
 * @brief Faxes controller
 *
 * This controller will be invoked from faxes dialplan context to handle
 * incomming and outgoint faxes requests.
 *
 * @package AGI
 * @subpackage FaxesController
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class FaxesController extends BaseController
{
    /**
     * Incoming Fax process action.
     *
     * This action is used when a DDI points to a FAX. It will setup the
     * connection and location for fax TIF file.
     */
    public function faxinAction ()
    {
        $exten = $this->agi->getExtension();
        $DDIMapper = new Mapper\DDIs();

        // Get DDI and check it has a valid related fax
        $DDI = $DDIMapper->findOneByField("DDI", $exten);
        $fax = $DDI->getFax();
        if (! $fax) {
            $this->agi->error("Fax DDI $exten has no virtual fax assigned.");
            $this->agi->hangup(16);
            return;
        }

        // Fax location is based on asterisk configuration
        $faxdir = $this->agi->getVariable(
                        "AST_CONFIG(asterisk.conf,directories,astspooldir)");

        // Set destination file an fax options
        $this->agi->setVariable("FAXFILE",
                        $faxdir . "/faxes/fax-" . $exten . "-" . time() . ".tif");
        $this->agi->setVariable("FAXOPT(headerinfo)", $fax->getName());
        $this->agi->setVariable("FAXOPT(localstationid)", $exten);

        // Create a new items for received fax data
        $faxIn = new Mapper\FaxesInOut();
        $faxIn->setFaxId($fax->getId())
            ->setSrc($this->agi->getVariable("CALLERID(number)"))
            ->setDst($exten)
            ->setType("In")
            ->setStatus("inprogress")
            ->save();

        // Store FaxId for later searchs
        $this->agi->setVariable("FAX_ID", $faxIn->getId());
    }

    /**
     * Incoming Fax Post-process action.
     *
     * This action will convert received fax from TIF format to PDF and
     * email to the user if requested.
     */
    public function processfaxinstatusAction ()
    {
        // Get current faxfile data
        $faxInOutMapper = new Mapper\FaxesInOut();
        $faxIn = $faxInOutMapper->find($this->agi->getVariable("FAX_ID"));

        // No fax! We're done then
        if (! $faxIn) {
            return;
        }

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

        // Convert TIF file to PDF before storing
        $output = shell_exec("/usr/bin/tiff2pdf -o $faxPDF $faxTIF 2>/dev/null");
        // TODO Check return value for errors (use exec instead of shell_exec?)
        // Remove received tif file after conversion
        unlink($faxTIF);

        // Check if this fax is associated with an email address
        $fax = $faxIn->getFax();
        if ($fax->getSendByEmail() == "1") {

            // Get faxdata values for mail message body and subject
            $faxSrc = $faxIn->getSrc();
            $faxDst = $faxIn->getDst();

            // Create attachment for PDF file
            $att = new Zend_Mime_Part(file_get_contents($faxPDF));
            $att->type = "application/pdf";
            $att->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
            $att->encoding = Zend_Mime::ENCODING_BASE64;
            $att->filename = "fax-$faxSrc-$faxDst.pdf";

            // Create an email for destination and send it
            $mail = new Zend_Mail();
            $mail->setBodyText(
                            "New fax received in $faxDst.\nSee attached PDF file.")
                ->setFrom("fax@as001.oasis-dev.irontec.com")
                ->addTo($fax->getEmail())
                ->setSubject("New fax received in $faxDst from $faxSrc")
                ->addAttachment($att)
                ->send();
        }

        // Store fax pages
        $faxIn->setPages($this->agi->getVariable("FAXOPT(pages)"));
        // Store FSO for this fax
        $faxIn->putFile($faxPDF);
        // Success!!
        $faxIn->setStatus('completed')->save();
    }

    public function faxoutAction ()
    {
        // Get FaxOut id from channel var
        $faxOutId = $this->agi->getVariable("FAX_ID");
        if (! $faxOutId) {
            $this->agi->error("No FAX_ID found in this channel.");
            $this->agi->hangup();
            return;
        }

        // Get Fax file filename
        $faxInOutMapper = new Mapper\FaxesInOut();
        $faxOut = $faxInOutMapper->find($faxOutId);
        if (! $faxOut) {
            $this->agi->error("There is no Fax with id $faxOutId");
            $this->agi->hangup();
            return;
        }

        // Get fax data
        $fax = $faxOut->getFax();

        // Prepare to call destination
        // TODO FIXME Get DDI without mapper dolan pls
        $DDIMapper = new Mapper\DDIs();
        $DDIOut = $DDIMapper->find($fax->getOutgoingDDI());

        // Fax without assigned DDIout
        if (! $DDIOut) {
            $this->agi->error("Fax " . $fax->getId() . "does not have DDIOut");
            $faxOut->setStats("error")->save();
            $this->agi->hangup();
            return;
        }

        // Set headers to place the outgoing call
        $this->agi->setVariable("CALLERID(num)", $DDIOut->getDDI());
        $this->agi->setVariable("CALLERID(name)", $fax->getName());
    }

    /**
     * Outgoing Fax process action.
     */
    public function faxoutsendAction ()
    {
        // Get FaxOut id from channel var
        $faxOutId = $this->agi->getVariable("FAX_ID");
        if (! $faxOutId) {
            $this->agi->error("No FAX_ID found in this channel.");
            $this->agi->hangup();
            return;
        }

        // Get Fax file filename
        $faxInOutMapper = new Mapper\FaxesInOut();
        $faxOut = $faxInOutMapper->find($faxOutId);
        // Mark this fax as in progress
        $faxOut->setStatus("inprogress")->save();
    }

    /**
     * Outgoing Fax Post-process action.
     */
    public function processfaxoutstatusAction ()
    {
        // Get current faxfile data
        $faxInOutMapper = new Mapper\FaxesInOut();
        $faxOut = $faxInOutMapper->find($this->agi->getVariable("FAX_ID"));

        // Check no errors happened during ReceiveFax
        $error = $this->agi->getVariable("FAXOPT(error)");
        $statusstr = $this->agi->getVariable("FAXOPT(statusstr)");
        if (! empty($error) && $statusstr != "OK") {
            // Show error message in asterisk CLI
            $this->agi->error("Error sending fax: $statusstr ($error)");
            // Mark this fax as error and save
            $faxOut->setStatus('error')->save();
            return;
        }

        // Store fax pages
        $faxOut->setPages($this->agi->getVariable("FAXOPT(pages)"));
        // Mark as success and save
        $faxOut->setStatus('completed')->save();

        // Remove temporal TIF file
        unlink($this->agi->getVariable("FAXOPT(filename)"));
    }
}
