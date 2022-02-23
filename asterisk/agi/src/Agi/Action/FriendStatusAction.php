<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

class FriendStatusAction
{
    const InvalidArgs           = 'INVALIDARGS';
    const ChanUnavailable       = 'CHANUNAVAIL';
    const Busy                  = 'BUSY';
    const Congestion            = 'CONGESTION';
    const NoAnswer              = 'NOANSWER';
    const Cancel                = 'CANCEL';
    const Forwarded             = 'FORWARDED';

    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var FriendInterface
     */
    protected $friend;

    /**
     * @var string
     */
    protected $dialStatus = null;

    /**
     * @var CallForwardAction
     */
    protected $callForwardAction;

    /**
     * FriendStatusAction constructor.
     *
     * @param Wrapper $agi
     * @param CallForwardAction $callForwardAction
     */
    public function __construct(
        Wrapper $agi,
        CallForwardAction $callForwardAction
    ) {
        $this->agi = $agi;
        $this->callForwardAction = $callForwardAction;
    }

    public function setFriend($friend)
    {
        $this->friend = $friend;
        return $this;
    }

    public function setDialStatus(string $dialStatus)
    {
        $this->dialStatus = $dialStatus;
        return $this;
    }

    public function process()
    {
        if (empty($this->friend)) {
            $this->agi->error("Friend is not properly defined. Check configuration.");
            return false;
        }

        // If no dialstatus has been provided, try to get Dial output
        if (empty($this->dialStatus)) {
            $this->dialStatus = $this->agi->getVariable("DIALSTATUS");
        }

        $forwarded = false;

        // Check Call Forward configuration configured with dialstatus
        switch ($this->dialStatus) {
            case FriendStatusAction::ChanUnavailable;
                $forwarded = $this->processCallForward('userNotRegistered');
                break;
            case FriendStatusAction::Busy:
            case FriendStatusAction::Congestion:
                $forwarded = $this->processCallForward('busy');
                if (!$forwarded) {
                    // No busy handler, send response
                    $this->agi->busy();
                }
                break;
            case FriendStatusAction::NoAnswer:
                $forwarded = $this->processCallForward('noAnswer');
                break;
            case FriendStatusAction::Cancel:
                $this->agi->hangup(16);
                break;
            case FriendStatusAction::Forwarded:
                $forwarded = $this->processCallForward('inconditional');
                break;
            default:
                break;
        }

        return $forwarded;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function processCallForward($type)
    {
        // Get active call forwards
        $criteria = [
            array('callForwardType', 'eq', $type),
            array('enabled', 'eq', '1'),
        ];

        /**
         * @var CallForwardSettingInterface[] $cfwSettings
         */
        $cfwSettings = $this->friend
            ->getCallForwardSettings(
                CriteriaHelper::fromArray(
                    $criteria
                )
            );

        // Process busy Call Forwards
        foreach ($cfwSettings as $cfwSetting) {
            $cfwType = $cfwSetting->getCallTypeFilter();
            if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                // Some output for the asterisk cli
                $this->agi->verbose("Call ended with status %s. Processing CallForward.", $this->dialStatus);

                $this->callForwardAction
                    ->setCallForward($cfwSetting)
                    ->process();

                return true;
            }
        }

        return false;
    }
}
