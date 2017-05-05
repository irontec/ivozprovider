<?php
require_once("CallsController.php");
use IvozProvider\Mapper\Sql as Mapper;
use Agi\Action\FaxCallAction;
use Agi\Action\ExternalFaxCallAction;

/**
 * @brief Controller for Incoming and Outgoing faxes
 *
 * @package AGI
 * @subpackage FaxesController
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class FaxesController extends CallsController
{
    /**
     * @brief Process fax after call status
     */
    public function dialAction ()
    {
        // Get fax file object
        $faxOut = $this->getFaxFile();

        // Set Company information
        $this->agi->setVariable("__COMPANYID", $faxOut->getFax()->getCompanyId());

        // Convert fax file from PDF to TIFF
        $pdfFile = $faxOut->fetchFile()->getFilePath();
        $tifFile = $faxOut->fetchFile()->getFilePath() . ".tif";
        $cmd = array(
                "/usr/bin/gs",
                "-g1728x1145 -r209x98",
                "-q -dNOPAUSE -dBATCH",
                "-sDEVICE=tiffg4 -sPAPERSIZE=a4",
                "-sOutputFile=". $tifFile,
                $pdfFile,
                "2>&1"
        );

        // Execute conversion command
        $this->agi->notice("Converting fax file [faxInOut%d] to TIFF.", $faxOut->getId());
        exec(implode(" ", $cmd), $output, $retval);
        if ($retval != 0) {
            $this->agi->error("Unable to convert fax file [faxInOut%d] to TIFF.", $faxOut->getId());
            $faxOut->setStatus('error')->save();
            return;
        } else {
            $faxOut->setStatus("inprogress")->save();
        }

        // ProcessDialStatus
        $faxExternalAction = new ExternalFaxCallAction($this);
        $faxExternalAction
            ->setCaller($faxOut->getFax())
            ->setFaxFile($faxOut)
            ->setDestination($faxOut->getDst())
            ->process();
    }

    /**
     * @brief Process fax after call status
     */
    public function dialstatusAction ()
    {
        // Get fax file object
        $faxOut = $this->getFaxFile();

        // Delete converted file after sending
        $tifFile = $faxOut->fetchFile()->getFilePath() . ".tif";
        if (file_exists($tifFile)) {
            unlink($tifFile);
        }

        $dialStatus = $this->agi->getVariable("DIALSTATUS");
        if (!empty($dialStatus)) {
            $this->agi->notice("Fax file [faxInOut%d] dial status %s", $faxOut->getId(), $dialStatus);
            // Store fax pages
            if ($dialStatus != "ANSWER"){
                // Mark as error and save
                $faxOut->setStatus('error')->save();
                return;
            }
        }
    }

    /**
     * @brif Process fax sending options
     */
    public function sendAction()
    {
        // Get fax file object
        $faxOut = $this->getFaxFile();

        // TIFF file to send
        $tifFile = $faxOut->fetchFile()->getFilePath() . ".tif";

        // Set recive fax options
        $this->agi->setVariable("FAX_OPT", "zf");
        $this->agi->setVariable("FAX_FILE", $tifFile);
    }


    /**
     * @brief Process fax after send status
     */
    public function sendstatusAction ()
    {
        // Get fax file object
        $faxOut = $this->getFaxFile();

        // Delete converted file after sending
        $tifFile = $faxOut->fetchFile()->getFilePath() . ".tif";
        if (file_exists($tifFile)) {
            unlink($tifFile);
        }

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

    }

    /**
     * @brief Process fax after call status
     */
    public function receivestatusAction ()
    {
        // Get fax file object
        $faxIn = $this->getFaxFile();

        // ProcessDialStatus
        $faxAction = new FaxCallAction($this);
        $faxAction
            ->setFaxInOut($faxIn)
            ->processStatus();
    }


    private function getFaxFile()
    {
        $faxid = $this->agi->getVariable("FAXFILE_ID");
        $faxInOutMapper = new Mapper\FaxesInOut();
        $faxInOut = $faxInOutMapper->find($faxid);

        if (empty($faxInOut)) {
            $this->agi->hangup();
            $this->agi->error("Fax %s not found in database. (BUG?)", $faxid);
        }

        return $faxInOut;
    }

}
