<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserStatusAction
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
     * @var UserInterface
     */
    protected $user;

    /**
     * @var string
     */
    protected $dialStatus = null;

    /**
     * @var CallForwardAction
     */
    protected $callForwardAction;

    /**
     * UserStatusAction constructor.
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

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setDialStatus(string $dialStatus)
    {
        $this->dialStatus = $dialStatus;
        return $this;
    }

    public function process()
    {
        if (empty($this->user)) {
            $this->agi->error("User is not properly defined. Check configuration.");
            return false;
        }

        // If no dialstatus has been provided, try to get Dial output
        if (empty($this->dialStatus)) {
            $this->dialStatus = $this->agi->getVariable("DIALSTATUS");
        }

        $forwarded = false;

        // Check Call Forward configuration configured with dialstatus
        switch ($this->dialStatus) {
            case UserStatusAction::ChanUnavailable;
                $forwarded = $this->processCallForward('userNotRegistered');
                break;
            case UserStatusAction::Busy:
            case UserStatusAction::Congestion:
                $forwarded = $this->processCallForward('busy');
                if (!$forwarded) {
                    // No busy handler, send response
                    $this->agi->busy();
                }
                break;
            case UserStatusAction::NoAnswer:
                $forwarded = $this->processCallForward('noAnswer');
                break;
            case UserStatusAction::Cancel:
                $this->agi->hangup(16);
                break;
            case UserStatusAction::Forwarded:
                $forwarded = $this->processCallForward('inconditional');
                break;
            default:
                break;
        }

        return $forwarded;
    }

    /**
     * @param $type
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
        $cfwSettings = $this->user->getCallForwardSettings(CriteriaHelper::fromArray($criteria));

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
