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
        $caller = $this->agi->getChannelCaller();
        $company = $caller->getCompany();
        $outboundPrefix = $company->getOutboundPrefix();

        // If Company has Outbound no prefix, number is always ok
        if (strlen($outboundPrefix) == 0)
            return true;

        // Check if the first number matches the prefix
        return (strpos($number, $outboundPrefix) === 0);
    }

    /**
     * @brief Check if the dialed number includes company's anonymous prefix
     *
     * Company can configure anonymous prefix than CAN be present in an outgoing
     * external call. If present the call will hide CallerId
     *
     * @param string $number Outgoing Dialed number
     * @return false if prefix is not present or company has no prefix, true otherwise
     */
    protected function checkCompanyAnonymousPrefix($number)
    {
        // Get company Data
        $caller = $this->agi->getChannelCaller();
        $company = $caller->getCompany();
        $anonymousPrefix = $company->getAnonymousPrefix();
        $outboundPrefix = $company->getOutboundPrefix();

        // If Company has no Anonymous Prefix, no anonymous
        if (strlen($anonymousPrefix) == 0)
            return false;

        // Remove company's outbound prefix
        if (substr($number, 0, strlen($outboundPrefix)) == $outboundPrefix)
            $number = substr($number, strlen($outboundPrefix));

        // Check if number starts with anonymous prefix
        return (strpos($number, $anonymousPrefix) === 0);
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
        $caller = $this->agi->getChannelCaller();
        $company = $caller->getCompany();

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
        $caller = $this->agi->getChannelCaller();

        // If origin is a user extension
        if ($caller instanceof \IvozProvider\Model\Users) {
            // Setup the update callid for the calling user
            $this->agi->setVariable("CONNECTED_LINE_SEND_SUB", "update-line,$e164number,1");
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
     * @param number in E.164 format
     */
    protected function checkDiversionNumber($company, $number)
    {
        if ($this->agi->getRedirecting('count')) {

            // Replace Diversion extensions with outgoing DDIs
            $diversionNum = $this->agi->getRedirecting('from-tag');
            if (($diversionExt = $company->getExtension($diversionNum))) {
                $this->agi->notice("Replacing invalid Diversion Detected from Extension %s", $diversionNum);
                $diversionUsers = $diversionExt->getUsers();
                $diversionUser = array_shift($diversionUsers);
                $diversionDDI = $diversionUser->getOutgoingDDI();

                // If user has OutgoingDDI rules, check if we have to override current DDI
                $outgoingDDIRule = $diversionUser->getOutgoingDDIRule();
                if ($outgoingDDIRule) {
                    $this->agi->verbose("Checking %s [user%d] Diversion outgoingDDI rules %d for destination %s",
                                    $diversionUser->getFullName(), $diversionUser->getId(),
                                    $outgoingDDIRule->getId(), $number);
                    $diversionDDI = $outgoingDDIRule->getOutgoingDDI($diversionDDI, $number);
                    if ($diversionDDI && $diversionDDI != $diversionUser->getOutgoingDDI()) {
                        $this->agi->notice("Rule %s [outgoingddirule%d] presented DDI to %s [ddi%d]",
                            $outgoingDDIRule->getName(), $outgoingDDIRule->getId(),
                            $diversionDDI->getDDIE164(), $diversionDDI->getId());
                        $this->agi->setRedirecting('from-num,i', $diversionDDI->getDDIE164());
                    }
                } else {
                    // Replace user extension with user outgoingDDI
                    $this->agi->setRedirecting('from-num,i', $diversionDDI->getDDIE164());
                }
            }

            // Check if the Diversion Number is a company DDI
            $diversionNum = $this->agi->getRedirecting('from-num');
            if(!$company->getDDI($diversionNum)) {
                // Check if the Diversion Number is a company DDI in E.164
                $diversionNum = $company->preferredToE164($diversionNum);
                if(!($ddi = $company->getDDI($diversionNum))) {
                    // Not a Company DDI nor a Company Extension. Remove it.
                    $this->agi->error("Removing invalid diversion header from %s", $diversionNum);
                    $this->agi->setRedirecting('count', 0);
                } else {
                    $this->agi->setRedirecting('from-num', $ddi->getDDIE164());
                }
            }
        }
    }

    protected function checkValidOrigin($number)
    {
        // Get call origin
        $origin = $this->agi->getChannelOrigin();

        if ($origin instanceof \IvozProvider\Model\Users) {
            // Get default user outgoing DDI
            $ddi = $origin->getOutgoingDDI();
            // If user has OutgoingDDI rules, check if we have to override current DDI
            $outgoingDDIRule = $origin->getOutgoingDDIRule();
            if ($outgoingDDIRule) {
                $this->agi->verbose("Checking ORIGIN %s [user%d] outgoingDDI rules %d for destination %s",
                                $origin->getFullName(), $origin->getId(),
                                $outgoingDDIRule->getId(), $number);
                $ddi = $outgoingDDIRule->getOutgoingDDI($ddi, $number);
                if ($ddi && $ddi != $origin->getOutgoingDDI()) {
                    $this->agi->notice("Rule %s [outgoingddirule%d] presented DDI to %s [ddi%d]",
                        $outgoingDDIRule->getName(), $outgoingDDIRule->getId(),
                        $ddi->getDDIE164(), $ddi->getId());
                }
            }
        } else if ($origin instanceof \IvozProvider\Model\Friends) {
            // Allow identification from any company DDI
            $callerIdNum = $this->agi->getCallerIdNum();
            $companyDDIs = $origin->getCompany()->getDDIs();
            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDDIE164()) {
                    $this->agi->notice("Friend \e[0;36m%s [friend%d]\e[0;93m presented origin matches company DDI %s [ddi%d].",
                            $origin->getName(), $origin->getId(), $origin->getDDIE164(), $origin->getId());
                    $ddi = $companyDDI;
                    break;
                }
            }

            // Use fallback outgoing DDI
            if (!isset($ddi)) {
                $ddi = $origin->getOutgoingDDI();
                if ($ddi) {
                    $this->agi->notice("Using fallback DDI %d [ddi%s] for friend \e[0;36m%s [friend%d]\e[0;93m because %s does not match any DDI.",
                        $ddi->getDDIE164(), $ddi->getId(), $origin->getname(), $origin->getId(), $callerIdNum);
                }
            }
        } else {
            // Origin is external number, restore incoming number to E.164
            $this->agi->setCallerIdNum($this->agi->getOrigCallerIdNum());
            return true;
        }

        // Updated presented number
        if ($ddi) {
            $this->agi->setCallerIdNum($ddi->getDDIE164());
            return true;
        } else {
            return false;
        }
    }
}
