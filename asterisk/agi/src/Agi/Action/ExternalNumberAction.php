<?php

namespace Agi\Action;

use Agi\ChannelInfo;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @class ExternalNumberAction
 *
 * @brief Manage outgoing external calls
 *
 */
class ExternalNumberAction
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
     * Destination number in E.164 format
     *
     * @var string
     */
    protected $number;

    /**
     * ExternalUserCallAction constructor.
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EntityManagerInterface $em
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EntityManagerInterface $em
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->em = $em;
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
        // Local variables
        $caller = $this->channelInfo->getChannelCaller();
        $origin = $this->channelInfo->getChannelOrigin();
        $number = $this->number;

        // Some feedback for asterisk cli
        $this->agi->notice("Processing External call from <green>%s</green> to %s", $caller, $number);

        // Get outgoing ddi from agent
        $callerDdi = $caller->getOutgoingDdi($number);

        // No valid DDI for this outgoing call!!
        if (!$callerDdi) {
            $this->agi->error("%s has not OutgoingDDI configured", $caller);
            $this->agi->hangup();
            return;
        }

        // Set origin presentation
        if (!is_null($origin)) {
            $originDdi = $origin->getOutgoingDdi($number);
            // No valid DDI for this outgoing call!!
            if (!$originDdi) {
                $this->agi->error("%s has not OutgoingDDI configured", $origin);
                $this->agi->hangup();
                return;
            }

            // Set origin presentation
            $this->agi->setCallerIdNum($originDdi->getDdie164());
        }

        // Add caller redirection information
        if (is_null($origin) || !$origin->isEqual($caller)) {
            // Set as diversion number the user extension
            $this->agi->setRedirecting('from-num,i', $callerDdi->getDdie164());
            $this->agi->setRedirecting('from-name', "");
        }

        // Determine if this call must be recorded based on caller DDI
        if (in_array($callerDdi->getRecordCalls(), array('all', 'outbound'))) {
            $this->agi->setVariable("_RECORD", "yes");
        }

        // Dial Options
        $options = "";

        // For record asterisk builtin feature code (FIXME Dont use both X's)
        if ($caller->getCompany()->getOnDemandRecord() == 2) {
            $options .= "xX";
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $number . '@proxytrunks');
        $this->agi->setVariable("DIAL_OPTS", $options);
        $this->agi->setVariable("DIAL_TIMEOUT", "");
        $this->agi->redirect('call-world', $number);
    }
}
