<?php

namespace Agi\Action;

class ExternalDDICallAction extends ExternalCallAction
{
    /**
     * @var integer
     */
    protected $_number;

    public function setDestination($number)
    {
        $this->_number = $number;
        return $this;
    }

    public function process()
    {
        // Local variables
        $ddi = $this->agi->getChannelCaller();
        $number = $this->_number;

        // Get company from the caller
        $company = $ddi->getCompany();

        // Some feedback for asterisk cli
        $this->agi->notice("Processing External call from DDI %s to %s",
                $ddi->getDDI(), $number);

        // If compnay has OutgoingDDI rules, check if we have to override current DDI
        $outgoingDDIRule = $company->getOutgoingDDIRule();
        if ($outgoingDDIRule) {
            $this->agi->verbose("Checking outgoingDDI rules %s for destination %s",
                            $outgoingDDIRule->getName(), $number);
            $ddi = $outgoingDDIRule->getOutgoingDDI($ddi, $number);
            if ($ddi != $company->getOutgoingDDI()) {
                $this->agi->notice("Rule %s [outgoingddirule%d] updated final DDI to %s [ddi%d]",
                    $outgoingDDIRule->getName(), $outgoingDDIRule->getId(),
                    $ddi->getDDI(), $ddi->getId());
            }
        }

        // Check if outgoing call can be tarificated
        if (!$this->checkTarificable($number)) {
            $this->agi->error("Destination %s can not be billed.", $number);
            $this->agi->decline();
            return;
        }

        // Set origin for not forwarded calls
        if ($this->agi->getRedirecting('count') == 0) {
            $this->agi->setCallerIdNum($ddi->getDDIE164());
        }

        // Check if the diversion header contains a valid number
        $this->checkDiversionNumber($company, $number);
        // Check if DDI has recordings enabled
        $this->checkDDIRecording($ddi);
        // Check if DDI belong to platform
        $this->checkDDIBounced($number);

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", "");
        $this->agi->setVariable("DIAL_TIMEOUT", "");
        $this->agi->redirect('call-world', $number);
    }
}
