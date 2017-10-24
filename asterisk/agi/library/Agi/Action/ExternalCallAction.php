<?php

namespace Agi\Action;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * @class ExternalCallAction
 *
 * @brief Manage outgoing external calls
 */
class ExternalCallAction extends RouterAction
{
    /**
     * @brief Determine if the call can be tarificable
     *
     * Only calls that can be tarificated are allowed to be placed. There is an
     * exception to this: if all Brand Pricing Plans are externally rated (the
     * tarification is done by a third party module), all calls are considered
     * tarificable.
     *
     * @param string $number Dialed number in E.164 format
     * @return true if call can be tarificated, false otherwise
     */
    protected function checkTarificable($number)
    {
        // Get Dialer company
        $caller = $this->agi->getChannelCaller();
        /** @var CompanyInterface $company */
        $company = $caller->getCompany();

        // Can the company pay this call??
        if ($company->getBrand()->willUseExternallyRating($company, $number)) {
            $this->agi->verbose("Skipping tarificate checking as Externally Rating will be used");
        } else {
            $pricingPlan = $company->isDstTarificable($number);
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
     * @brief Check if the dialer requested recording of outgoing calls
     *
     * DDIs can be configured to record outgoing calls (or all calls).
     * This function will mark the outgoing channel to add a recording header for
     * proxytrunks.
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi Outgoing DDI
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
     * @param string $number dialed number in E.164 format
     */
    protected function checkDDIBounced($number)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var  \Ivoz\Provider\Domain\Model\Ddi\DdiRepository $ddiRepository */
        $ddiRepository = $em->getRepository('Ivoz\Provider\Domain\Model\DDi\Ddi');

        /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $internalDDI */
        $internalDDI = $ddiRepository->findOneBy([
            "ddie164" => $number
        ]);

        if (!empty($internalDDI)) {
            $this->agi->notice("DDI $number belongs to us, request bounce back this call");
            $this->agi->setVariable("_BOUNCEME", "yes");
        }
    }

    /**
     * @brief Check if the diversion header contains a valid number
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     * @param integer $number in E.164 format
     */
    protected function checkDiversionNumber($company, $number)
    {
        if ($this->agi->getRedirecting('count')) {

            // Replace Diversion extensions with outgoing DDIs
            $diversionNum = $this->agi->getRedirecting('from-tag');
            if (($diversionExt = $company->getExtension($diversionNum))) {
                $this->agi->notice("Replacing invalid Diversion Detected from Extension %s", $diversionNum);

                // Get user using this extension as screenextension
                $diversionUser = $diversionExt->getScreenUser();
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
            // Check if the Diversion Number is a company DDI in E.164
            if(!($ddi = $company->getDDI($diversionNum))) {
                // Not a Company DDI nor a Company Extension. Remove it.
                $this->agi->error("Removing invalid diversion header from %s", $diversionNum);
                $this->agi->setRedirecting('count', 0);
            } else {
                $this->agi->setRedirecting('from-num', $ddi->getDDIE164());
            }
        }
    }

    protected function checkValidOrigin($number)
    {
        // Get call origin
        $origin = $this->agi->getChannelOrigin();

        if ($origin instanceof \Ivoz\Provider\Domain\Model\User\UserInterface) {
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
        } else if ($origin instanceof \Ivoz\Provider\Domain\Model\Friend\FriendInterface) {
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
