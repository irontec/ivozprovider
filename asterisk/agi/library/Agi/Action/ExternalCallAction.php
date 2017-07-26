<?php

namespace Agi\Action;

use IvozProvider\Mapper\Sql as Mapper;

/**
 * @class ExternalCallAction
 *
 * @brief Manage outgoing external calls
 */
class ExternalCallAction extends RouterAction
{
    /**
     * @brief Check if the dialed number starts with Company outbound prefix
     *
     * Company can configure outbound prefix that MUST be present in all outgoing
     * external calls. This prefix only exists for compatibility with old pbx
     * behaviours where the prefix was needed to make difference between external
     * and internal calls.
     *
     * @param string $number Outgoing Dialed number
     * @return true if prefix is present or company has no prefix, false otherwise
     */
    protected function checkCompanyOutboundPrefix($number)
    {
        // Get company Data
        $company = $this->_caller->getCompany();
        $outboundPrefix = $company->getOutboundPrefix();

        // If Company has Outbound no prefix, number is always ok
        if (strlen($outboundPrefix) == 0)
            return true;

        // Check if the first number matches the prefix
        return (strpos($number, $outboundPrefix) === 0);
    }

    /**
     * @brief Determine if the call can be tarificable
     *
     * Only calls that can be tarificated are allowed to be placed. There is an
     * exception to this: if all Brand Pricing Plans are externally rated (the
     * tarification is done by a third party module), all calls are considered
     * tarificable.
     *
     * @param string $e164number Dialed number in E.164 format
     * @return true if call can be tarificated, false otherwise
     */
    protected function checkTarificable($e164number)
    {
        // Get Dialer company
        $company = $this->_caller->getCompany();

        // Can the company pay this call??
        if ($company->getBrand()->willUseExternallyRating($company, $e164number)) {
            $this->agi->verbose("Skipping tarificate checking as Externally Rating will be used");
        } else {
            $pricingPlan = $company->isDstTarificable($e164number);
            if (!$pricingPlan) {
                return false;
            }
            // Log what Pricing plan has been selected
            $this->agi->verbose("Using Pricing Plan %s [pricingPlan%d]",
                            $pricingPlan->getName(), $pricingPlan->getId());
        }
        return true;
    }

    /**
     * @brief Update origin connected line with destination
     *
     * If the origin is a well know terminal, update its connected line to reflect
     * the new external dialed number.
     *
     * TODO This may have undesired behaviours, like changing the dialed number
     *   by an user.
     *
     * @param string $e164number Dialed number in E.164 format
     */
    protected function updateOriginConnectedLine($e164number, $originDDI)
    {
        // Get caller company
        $company = $this->_caller->getCompany();
        // Get origin extension
        $origin = $this->agi->getCallerIdNum();

        // If origin is a user extension
        if (($extension = $company->getExtension($origin))) {
            $originUser = $extension->getUser();

            $this->agi->setVariable("USERID", $originUser->getId());

            // Setup the update callid for the calling user
            $this->agi->setVariable("CONNECTED_LINE_SEND_SUB", "update-line,$e164number,1");

            // Set as Display number users Outgoing DDI
            $this->agi->setVariable("CALLERID(num)", $originDDI->getDDIE164());
        }
    }

    /**
     * @brief Check if the dialer requested recording of outgoing calls
     *
     * DDIs can be configured to record outgoing calls (or all calls).
     * This function will mark the outgoing channel to add a recording header for
     * proxytrunks.
     *
     * @param \IvozProvider\Model\DDI $ddi Outgoing DDI
     */
    protected function checkDDIRecording($ddi)
    {
        if (!$ddi) return;

        if (in_array($ddi->getRecordCalls(), array('all', 'outbound'))) {
            $this->agi->setVariable("_RECORD", "yes");
        }
    }

    /**
     * @brief Check if the dialed external number belongs to our platform
     *
     * If outgoing number belongs to our platform we will mark it with a header
     * before placing the call to proxytrunks. This will allow to handle it as
     * an incoming call with a new callid.
     *
     * @param string $e164number dialed number in E.164 format
     */
    protected function checkDDIBounced($e164number)
    {
        $DDIMapper = new Mapper\DDIs();
        $internalDDI = $DDIMapper->findOneByField("DDIE164", $e164number);
        if (!empty($internalDDI)) {
            $this->agi->notice("DDI $e164number belongs to us, request bounce back this call");
            $this->agi->setVariable("_BOUNCEME", "yes");
        }
    }

    /**
     * @brief Check if the diversion header contains a valid number
     *
     * @param Company owner of the diversion number
     */
    protected function checkDiversionNumber($company)
    {
        if ($this->agi->getRedirecting('count')) {
            // Check if the Diversion Number is a company extension
            $diversionNum = $this->agi->getRedirecting('from-num');
            if (($diversionExt = $company->getExtension($diversionNum))) {
                $this->agi->notice("Replacing invalid Diversion Detected from Extension %s", $diversionNum);
                $diversionUsers = $diversionExt->getUsers();
                $diversionUser = array_shift($diversionUsers);
                // Replace user extension with user outgoingDDI
                $this->agi->setRedirecting('from-num,i', $diversionUser->getOutgoingDDI()->getDDIE164());

            // Check if the Diversion Number is a company DDI
            } else if (!$company->getDDI($diversionNum)) {
                // Not a Company DDI nor a Company Extension. Remove it.
                $this->agi->error("Removing invalid diversion header from %s", $diversionNum);
                $this->agi->setRedirecting('count', 0);
            }
        }
    }

}
