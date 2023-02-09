<?php

namespace Agi\Action;

use Agi\Agents\ResidentialAgent;
use Agi\Agents\UserAgent;
use Agi\Agents\FriendAgent;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

class CallForwardAction
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
     * Max allowed Call forwards from a channel
     *
     * @var int
     */
    protected $_maxRedirections = 5;

    /**
     * @var CallForwardSettingInterface|null
     */
    protected $cfw;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * CallForwardAction constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->routerAction = $routerAction;
    }

    /**
     * @param CallForwardSettingInterface $cfw
     * @return $this
     */
    public function setCallForward(CallForwardSettingInterface $cfw)
    {
        $this->cfw = $cfw;
        return $this;
    }

    public function process()
    {
        if (is_null($this->cfw)) {
            $this->agi->error("CallForward is not properly defined. Check configuration.");
            return;
        }

        // Some CLI information
        $this->agi->notice("Processing %s call forward", $this->cfw->getCallForwardType());

        // Use CFW owner as caller on following routes
        $forwarder = $this->cfw->getUser();
        if ($forwarder) {
            $caller = new UserAgent($this->agi, $forwarder);
            $this->agi->setVariable("_USERID", $forwarder->getId());
        } else {
            $forwarder = $this->cfw->getResidentialDevice();
            if ($forwarder) {
                $caller = new ResidentialAgent($this->agi, $forwarder);
                $this->agi->setVariable("_RESIDENTIALDEVICEID", $forwarder->getId());
            } else {
                $forwarder = $this->cfw->getFriend();
                if (!$forwarder) {
                    // Cfw without owner. This should not happen.
                    $this->agi->error("Call forward without owner. Check configuration.");
                    return;
                }

                $caller = new FriendAgent($this->agi, $forwarder);
                $this->agi->setVariable("_FRIENDID", $forwarder->getId());
            }
        }

        // Set the new caller
        $this->channelInfo->setChannelCaller($caller);

        /**
         * Set Diversion reason based on current Call Forward settings
         *
         * https://wiki.asterisk.org/wiki/display/AST/Function_REDIRECTING
         */
        switch ($this->cfw->getCallForwardType()) {
            case 'inconditional':
                $this->agi->setRedirecting('reason,i', 'cfu');
                break;
            case 'noAnswer':
                $this->agi->setRedirecting('reason,i', 'cfnr');
                break;
            case 'busy':
                $this->agi->setRedirecting('reason,i', 'cfb');
                break;
            case 'userNotRegistered':
                $this->agi->setRedirecting('reason,i', 'unavailable');
                break;
        }

        // Avoid Redirection loops
        $count = $this->agi->getRedirecting('count');
        if ($count < $this->_maxRedirections) {
            $this->agi->setRedirecting('count,i', ++$count);
        } else {
            $this->agi->error("Max %d redirection reached. Leaving.", $count);
            $this->agi->hangup(44);
            return;
        }

        // Set as diversion number the user extension
        $this->agi->setRedirecting('from-num', $caller->getExtensionNumber());

        // Route based on configured type
        $this->routerAction
            ->setRouteType($this->cfw->getTargetType())
            ->setRouteExtension($this->cfw->getExtension())
            ->setRouteExternal($this->cfw->getNumberValueE164())
            ->setRouteVoicemail($this->cfw->getVoicemail(), true)
            ->route();
    }
}
