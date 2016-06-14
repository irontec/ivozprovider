<?php

namespace Agi\Action;

use IvozProvider\Mapper\Sql as Mapper;

class ExternalCallAction extends RouterAction
{
    protected $_company;

    protected $_number;

    public function setCompany($company)
    {
        $this->_company = $company;
        return $this;
    }

	public function setDestination($number)
	{
	    $this->_number = $number;
	    return $this;
	}

  	public function process()
    {
  	    if (empty($this->_number)) {
  	        $this->agi->error("Calling to an empty number?. Check configuration.");
  	        return;
  	    }

        // Local variables
  	    $user = $this->_user;
  	    $number = $this->_number;
        $company = $this->_company;

        // Get company from the user
        if (is_null($company)) {
            $company = $user->getCompany();
        }

        // Some feedback for asterisk cli
        if ($user) {
            $this->agi->notice("Processing External call from %s [user%d] to %s",
                $user->getFullName(), $user->getId(), $number);
        } else {
            $this->agi->notice("Processing External call from DDI %s to %s",
                $this->agi->getExtension(), $number);
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
        // Check If user can place this call
        if ($user) {
            // Convert number to user prefered format to check ACLs
            $aclNumber = $company->preferredToACL($number);
            // Check the user has this call allowed in its ACL
            $this->agi->verbose("Checking if %s [user%d] can call %s",
                            $user->getFullName(), $user->getId(), $aclNumber);
            if (!$user->hasSrcUserPerm($aclNumber)) {
                $this->agi->error("User is not allowed to place this call.");
                $this->agi->hangup(57); // AST_CAUSE_BEARERCAPABILITY_NOTAUTH
                return;
            }
        }

        /*****************************************************************
         * E164 FIXUPS
         ****************************************************************/
        // Add the Calling code based on who place this call
        if ($user) {
            $number = $user->preferredToE164($number);
        } else {
            $number = $company->preferredToE164($number);
        }

        /*****************************************************************
         * TARIFICATE CHECKING
         ****************************************************************/
        // Can the company pay this call??
        $pricingPlan = $company->isDstTarificable($number);
        if (!$pricingPlan) {
            $this->agi->error("Destination %s can not be billed.", $number);
            $this->agi->hangup(52); // AST_CAUSE_OUTGOING_CALL_BARRED
            return;
        }

        // Log what Pricing plan has been selected
        $this->agi->verbose("Using Pricing Plan %s [pricingPlan%d]",
                $pricingPlan->getName(), $pricingPlan->getId());

        /*****************************************************************
         * ORIGIN DDI PRESENTATION
         ****************************************************************/
        if ($user) {
            // Set Outgoing number
            $company = $user->getCompany();
            $callerExt = $this->agi->getCallerId('num');

            if (($extension = $company->getExtension($callerExt))) {
                $callerUser = $extension->getUser();
                $outddi = $callerUser->getOutgoingDDINumber();
                if (empty($outddi)) {
                    $this->agi->error("User %s has no external DDI", $user->getId());
                    return;
                }

                // Set as Display number users Outgoing DDI
                $this->agi->setVariable("CALLERID(num)", $outddi);
                $this->agi->setVariable("USERID", $user->getId());

                // Setup the update callid for the calling user
                $this->agi->setVariable("CONNECTED_LINE_SEND_SUB", "update-line,$number,1");
            }
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", "");
        $this->agi->redirect('call-world', $number);
  	}
}
