<?php

namespace Agi\Action;

class ExternalDDICallAction extends ExternalCallAction
{
    protected $_number;

    public function setDestination($number)
    {
        $this->_number = $number;
        return $this;
    }

    public function process()
    {
        // Local variables
        $ddi = $this->_caller;
        $number = $this->_number;

        // Get company from the caller
        $company = $ddi->getCompany();

        // Some feedback for asterisk cli
        $this->agi->notice("Processing External call from DDI %s to %s",
                $ddi->getDDI(), $number);

        // Check if dialed number has company's outbound prefix
        if (!$this->checkCompanyOutboundPrefix($number)) {
            $this->agi->error("Destination number %s without [company%d] outbound prefix",
                            $number, $company->getId());
            $this->agi->decline();
            return;
        }

        // Convert to E.164 format
        $e164number = $company->preferredToE164($number);

        // Check if outgoing call can be tarificated
        if (!$this->checkTarificable($e164number)) {
            $this->agi->error("Destination %s can not be billed.", $e164number);
            $this->agi->decline();
            return;
        }

        // Update caller displayed number
        $this->updateOriginConnectedLine($e164number);
        // Check if DDI has recordings enabled
        $this->checkDDIRecording($ddi);
        // Check if DDI belong to platform
        $this->checkDDIBounced($e164number);

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $e164number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", "");
        $this->agi->setVariable("DIAL_TIMEOUT", "");
        $this->agi->redirect('call-world', $e164number);
    }
}
