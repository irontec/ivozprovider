<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;

class FriendCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var FriendInterface|null
     */
    protected $friend;

    /**
     * @var string
     */
    protected $destination;

    /**
     * @var FriendStatusAction
     */
    protected $friendStatusAction;

    /**
     * FriendCallAction constructor.
     *
     * @param Wrapper $agi
     */
    public function __construct(
        Wrapper $agi,
        FriendStatusAction $friendStatusAction
    ) {
        $this->agi = $agi;
        $this->friendStatusAction = $friendStatusAction;
    }

    /**
     * @param FriendInterface|null $friend
     * @return $this
     */
    public function setFriend(FriendInterface $friend = null)
    {
        $this->friend = $friend;
        return $this;
    }

    /**
     * @param string|null $number
     * @return $this
     */
    public function setDestination(string $number = null)
    {
        $this->destination = $number;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $friend = $this->friend;
        $number = $this->destination;

        if (is_null($friend)) {
            $this->agi->error("Friend is not properly defined. Check configuration.");
            return;
        }

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s through friend <cyan>%s</cyan>", $number, $friend);

        // Check if user has call forwarding enabled
        $forwarded = $this->friendStatusAction
            ->setFriend($friend)
            ->setDialStatus(FriendStatusAction::Forwarded)
            ->process();

        if ($forwarded) {
            return;
        }

        // Intervpbx friends can only call to valid extensions in destination company
        if ($friend->isInterPbxConnectivity() && !$friend->getInterCompanyExtension($number)) {
            $this->agi->error("%s is NOT a valid extension in %s", $number, $friend->getInterCompany());
            return;
        }

        // Check if user is available before placing the call
        $endpointName = $friend->getSorcery();

        // Configure Dial options
        $timeout = $this->getDialTimeout();
        $options = "";

        if ($this->getFriendStatusRequired()) {
            $options .= "g";
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $number);
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-friend', $number);
    }


    /**
     * If Friend has NoAnswer Call forward setting, return the dial timeout
     *
     * @return string
     */
    private function getDialTimeout()
    {
        $timeout = null;

        // Get active NoAnswer call forwards
        $criteria = [
            array('callForwardType', 'eq', 'noAnswer'),
            array('enabled', 'eq', '1'),
        ];

        /**
         * @var CallForwardSettingInterface[] $cfwSettings
         */
        $cfwSettings = $this->friend
            ->getCallForwardSettings(
                CriteriaHelper::fromArray($criteria)
            );

        foreach ($cfwSettings as $cfwSetting) {
            $cfwType = $cfwSetting->getCallTypeFilter();
            if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                $this->agi->verbose("Call Forward No answer enabled [%s]. Setting call timeout.", $cfwSetting);
                $timeout = $cfwSetting->getNoAnswerTimeout();
            }
        }

        return ($timeout) ?: "10800";
    }

    /**
     * Determine if we must check call status after dialing the friend
     *
     * @return boolean
     */
    private function getFriendStatusRequired()
    {
        // internal or external call
        $callType = $this->agi->getCallType();

        // Build the criteria to look for call forward settings
        $criteria = [
            [
                'or' => [
                    ['callForwardType', 'eq', 'noAnswer'],
                    ['callForwardType', 'eq', 'busy'],
                    ['callForwardType', 'eq', 'userNotRegistered'],
                ]
            ],
            [
                'or' => [
                    ['callTypeFilter', 'eq', 'both'],
                    ['callTypeFilter', 'eq', $callType],
                ]
            ],
            ['enabled', 'eq', '1']
        ];

        /** @var CallForwardSettingInterface[] $cfwSettings */
        $cfwSettings = $this->friend
            ->getCallForwardSettings(
                CriteriaHelper::fromArray($criteria)
            );

        // Return true if any of the requested Call forwards exist
        $settingNotEmpty = !empty($cfwSettings);
        return $settingNotEmpty;
    }
}
