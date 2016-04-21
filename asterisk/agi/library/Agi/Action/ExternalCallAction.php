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

  	    // If this call was originated from a user, check permissions
  	    if (!empty($user)) {
            // Can the user pay this call??
            if (!$user->isDstTarificable($number)) {
                $this->agi->error("Destination %s can not be billed.", $number);
                return;
            }

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
  	    }

        // Update Called name
        $this->agi->setConnectedLine('name,i', '');
        $this->agi->setConnectedLine('num,i', $number);

        // Get outbound Proxytrunk and dialOptions
        $proxyTrunks = new Mapper\ProxyTrunks();
        $proxyTrunksList = $proxyTrunks->fetchList();

        // Randomize ProxyTrunk Selection
        shuffle($proxyTrunksList);
        // Select the first available Trunk
        foreach ($proxyTrunksList as $proxyTrunk) {
            if ($this->agi->getDeviceState($proxyTrunk->getName()) != "UNAVAILABLE") {
                break;
            }
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@' . $proxyTrunk->getName());
        $this->agi->setVariable("DIAL_OPTS", "");
        $this->agi->redirect('call-world', $number);
  	}
}
