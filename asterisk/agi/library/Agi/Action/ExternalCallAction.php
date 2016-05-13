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

        // Get company Data
        $callingCode = $company->getCountries()->getCallingCode();
        $outboundPrefix = $company->getOutboundPrefix();

        /*****************************************************************
         * COMPANY PREFIX CHECKING (FAST CALL DROPS)
         ****************************************************************/
        if (strpos($number, $outboundPrefix) !== 0) {
            // Check the user has this call allowed in its ACL
            $this->agi->error("Destination without Company [company%d] prefix: %d",
                            $company->getId(), $outboundPrefix);
            $this->agi->hangup(21); // Declined
            return;
        }

        /*****************************************************************
         * ACL CHECKING
         ****************************************************************/
        // Check If user can place this call
        if ($user) {
            $aclNumber = preg_replace("/^$outboundPrefix/", "", $number);
            // Remove Calling code If matches the company
            $aclNumber = preg_replace("/^00$callingCode/", "", $aclNumber, 1, $count);
            // Add Company prefix
            $aclNumber = $outboundPrefix . $aclNumber;

            // Check the user has this call allowed in its ACL
            $this->agi->verbose("Checking if %s [user%d] can call %d",
                            $user->getFullName(), $user->getId(), $aclNumber);
            if (!$user->hasSrcUserPerm($aclNumber)) {
                $this->agi->error("User is not allowed to place this call.");
                $this->agi->hangup(21); // Declined
                return;
            }
        }

        /*****************************************************************
         * E164 FIXUPS
         ****************************************************************/
        // Remove company outbound prefix
        $number = preg_replace("/^$outboundPrefix/", "", $number);

        // Remove international code
        $number = preg_replace("/^00/", "", $number, 1, $found);

        // No international code found
        if (!$found) {
            // Add the Calling code based on who place this call
            if ($user) {
                $country = $user->getCountry();
            } else {
                $country = $company->getCountries();
            }
            // Append user Calling code
            $callingCode = $country->getCallingCode();
            $number = $callingCode . $number;
        }

        /*****************************************************************
         * TARIFICATE CHECKING
         ****************************************************************/
/*
        // Can the user pay this call??
        if (!$user->isDstTarificable($number)) {
            $this->agi->error("Destination %s can not be billed.", $number);
            return;
        }
*/
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
            }
        } else {
            // FIXME COMPANY DEFAULT DDI OUT ???
        }

        // Update Called name
        $this->agi->setConnectedLine('name,i', '');
        $this->agi->setConnectedLine('num,i', $number);

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", "");
        $this->agi->redirect('call-world', $number);
  	}
}
