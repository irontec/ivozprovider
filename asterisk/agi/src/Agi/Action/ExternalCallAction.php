<?php

namespace Agi\Action;

use Agi\ChannelInfo;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * @class ExternalCallAction
 *
 * @brief Manage outgoing external calls
 */
class ExternalCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ChannelInfo
     */
    protected $channelInfo;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * ExternalCallAction constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EntityManagerInterface $em
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EntityManagerInterface $em
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->em = $em;
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
        /** @var  \Ivoz\Provider\Domain\Model\Ddi\DdiRepository $ddiRepository */
        $ddiRepository = $this->em->getRepository('Ivoz\Provider\Domain\Model\DDi\Ddi');

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
                    if ($diversionDDI && $diversionDDI->getDdie164() != $diversionUser->getOutgoingDDI()->getDdie164()) {
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
                $this->agi->setRedirecting('from-num', $ddi->getDdie164());
            }
        }
    }

    protected function checkValidOrigin($number)
    {
        // Get call origin
        $origin = $this->channelInfo->getChannelOrigin();

        if ($origin instanceof UserInterface) {
            // Get default user outgoing DDI
            $ddi = $origin->getOutgoingDDI();
            // If user has OutgoingDDI rules, check if we have to override current DDI
            $outgoingDDIRule = $origin->getOutgoingDDIRule();
            if ($outgoingDDIRule) {
                $this->agi->verbose("Checking ORIGIN %s rule %s for destination %s", $origin, $outgoingDDIRule, $number);
                $ddi = $outgoingDDIRule->getOutgoingDDI($ddi, $number);
                if ($ddi && $ddi->getDdie164() != $origin->getOutgoingDDI()->getDdie164()) {
                    $this->agi->notice("Rule %s presented DDI to %s", $outgoingDDIRule, $ddi);
                }
            }
        } else if ($origin instanceof FriendInterface) {
            // Allow identification from any company DDI
            $callerIdNum = $this->agi->getCallerIdNum();

            /** @var DdiInterface[] $companyDDIs */
            $companyDDIs = $origin->getCompany()->getDDIs();
            foreach ($companyDDIs as $companyDDI) {
                if ($callerIdNum === $companyDDI->getDdie164()) {
                    $this->agi->notice("Friend %s presented origin matches company DDI %s", $origin, $companyDDI);
                    $ddi = $companyDDI;
                    break;
                }
            }

            // Use fallback outgoing DDI
            if (!isset($ddi)) {
                $ddi = $origin->getOutgoingDDI();
                if ($ddi) {
                    $this->agi->notice(
                        "Using fallback DDI %s for friend %s because %s does not match any DDI.",
                        $ddi, $origin, $callerIdNum);
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
