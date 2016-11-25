<?php

namespace Agi\Action;

use IvozProvider\Mapper\Sql as Mapper;

class ExternalCallAction extends RouterAction
{
    protected $_number;

    protected $_checkACL = true;

    public function setDestination($number)
    {
        $this->_number = $number;
        return $this;
    }

    public function setCheckACL($check)
    {
        $this->_checkACL = $check;
        return $this;
    }

    public function process()
    {
        if (empty($this->_number)) {
            $this->agi->error("Calling to an empty number?. Check configuration.");
            return;
        }

        // Local variables
        $caller = $this->_caller;
        $number = $this->_number;

        // Get company from the caller (It should be User or DDI)
        $company = $caller->getCompany();

        // Some feedback for asterisk cli
        if ($caller instanceof \IvozProvider\Model\Raw\Users) {
            $this->agi->notice("Processing External call from %s [user%d] to %s",
                $caller->getFullName(), $caller->getId(), $number);
        } else {
            $this->agi->notice("Processing External call from DDI %s to %s",
                $caller->getDDI(), $number);
        }

        /*****************************************************************
         * COMPANY PREFIX CHECKING (FAST CALL DROPS)
         ****************************************************************/
        // Get company Data
        $callingCode = $company->getCountries()->getCallingCode();
        $outboundPrefix = $company->getOutboundPrefix();

        // If Company has Outbound Prefix, check it's present
        if (strlen($outboundPrefix) !== 0 && strpos($number, $outboundPrefix) !== 0) {
            $this->agi->error("Destination number %s without [company%d] prefix: %s",
                            $number, $company->getId(), $outboundPrefix);
            $this->agi->hangup(21); // Decline
            return;
        }

        /*****************************************************************
         * ACL CHECKING
         ****************************************************************/
        // If ACL checks are requested
        if ($this->_checkACL) {
            // Check If user can place this call
            if ($caller instanceof \IvozProvider\Model\Raw\Users) {
                // Convert number to user prefered format to check ACLs
                $aclNumber = $company->preferredToACL($number);
                // Check the user has this call allowed in its ACL
                $this->agi->verbose("Checking if %s [user%d] can call %s",
                                $caller->getFullName(), $caller->getId(), $aclNumber);
                if (!$caller->hasSrcUserPerm($aclNumber)) {
                    $this->agi->error("User is not allowed to place this call.");
                    $this->agi->hangup(57); // AST_CAUSE_BEARERCAPABILITY_NOTAUTH
                    return;
                }
            }
        } else {
            $this->agi->verbose("Skipping ACL Checking as requested");
        }

        /*****************************************************************
         * E164 FIXUPS
         ****************************************************************/
        // Add the Calling code based on who place this call
        if ($caller instanceof  \IvozProvider\Model\Raw\Users) {
            $number = $caller->preferredToE164($number);
        } else {
            $number = $company->preferredToE164($number);
        }

        /*****************************************************************
         * TARIFICATE CHECKING
         ****************************************************************/
        // Can the company pay this call??
        if ($company->getBrand()->willUseExternallyRating($company, $number)) {
            $this->agi->verbose("Skipping tarificate checking as Externally Rating will be used");
        } else {
            $pricingPlan = $company->isDstTarificable($number);
            if (!$pricingPlan) {
                $this->agi->error("Destination %s can not be billed.", $number);
                $this->agi->hangup(52); // AST_CAUSE_OUTGOING_CALL_BARRED
                return;
            }

            // Log what Pricing plan has been selected
            $this->agi->verbose("Using Pricing Plan %s [pricingPlan%d]",
                    $pricingPlan->getName(), $pricingPlan->getId());
        }

        /*****************************************************************
         * ORIGIN DDI PRESENTATION
         ****************************************************************/
        $origin = $this->agi->getCallerIdNum();
        // If origin is a user extension
        if (($extension = $company->getExtension($origin))) {
            $originUser = $extension->getUser();
            $originDDI = $originUser->getOutgoingDDI();
            if (empty($originDDI)) {
                $this->agi->error("User %s has no external DDI", $originUser->getId());
                return;
            }

            $this->agi->setVariable("USERID", $originUser->getId());

            // Setup the update callid for the calling user
            $this->agi->setVariable("CONNECTED_LINE_SEND_SUB", "update-line,$number,1");

            // Set as Display number users Outgoing DDI
            $this->agi->setVariable("CALLERID(num)", $originDDI->getDDIE164());
        }

        /*****************************************************************
         * RECORD EXTERNAL DDI
         ****************************************************************/
        // If caller is a ddi and is configured to record
        if ($caller instanceof \IvozProvider\Model\Raw\DDIs) {
            if (in_array($caller->getRecordCalls(), array('all', 'outbound'))) {
                $this->agi->setVariable("_RECORD", "yes");
            }
        }
        // If origin is an user with a DDI configured to record
        if (!empty($originDDI)) {
            if (in_array($originDDI->getRecordCalls(), array('all', 'outbound'))) {
                $this->agi->setVariable("_RECORD", "yes");
            }
        }

        /*****************************************************************
         * BOUNCE INTERNAL DDI
         ****************************************************************/
        // Check if incoming DDI is for us
        $DDIMapper = new Mapper\DDIs();
        $internalDDI = $DDIMapper->findOneByField("DDIE164", $number);
        if (!empty($internalDDI)) {
            $this->agi->notice("DDI $number belongs to use, request bounce back this call");
            $this->agi->setVariable("_BOUNCEME", "yes");
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", "");
        $this->agi->redirect('call-world', $number);
    }
}
