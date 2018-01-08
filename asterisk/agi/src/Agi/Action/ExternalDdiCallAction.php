<?php

namespace Agi\Action;

use Agi\ChannelInfo;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

class ExternalDdiCallAction extends ExternalCallAction
{
    /**
     * @var string
     */
    protected $number;

    /**
     * ExternalDDICallAction constructor.
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
        parent::__construct($agi, $channelInfo, $em);
    }

    /**
     * @param string|null $number
     * @return $this
     */
    public function setDestination(string $number = null)
    {
        $this->number = $number;
        return $this;
    }

    public function process()
    {
        /** @var DdiInterface $ddi */
        $ddi = $this->channelInfo->getChannelCaller();
        $number = $this->number;

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
            if ($ddi->getDdie164() != $company->getOutgoingDDI()->getDdie164()) {
                $this->agi->notice("Rule %s [outgoingddirule%d] updated final DDI to %s [ddi%d]",
                    $outgoingDDIRule->getName(), $outgoingDDIRule->getId(),
                    $ddi->getDDI(), $ddi->getId());
            }
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
