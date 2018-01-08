<?php
namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;


class CallForwardAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * Max allowed Call forwards from a channel
     *
     * @var int
     */
    protected $_maxRedirections = 5;

    /**
     * @var CallForwardSettingInterface
     */
    protected $cfw;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var VoiceMailAction
     */
    protected $voiceMailAction;

    /**
     * CallForwardAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     * @param VoiceMailAction $voiceMailAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction,
        VoiceMailAction $voiceMailAction
    )
    {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
        $this->voiceMailAction = $voiceMailAction;
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

        // Use Redirecting user as caller on following routes
        $this->agi->setChannelCaller($this->cfw->getUser());

        // Get Call forward user
        $caller = $this->agi->getChannelCaller();

        if ($this->cfw->getTargetType() == RouterAction::Voicemail) {
            // Set as diversion number the user extension
            $this->agi->setRedirecting('from-num,i', $caller->getExtensionNumber());
            $this->agi->setRedirecting('from-tag,i', $caller->getExtensionNumber());
            $this->agi->setRedirecting('from-name', $caller->getFullName());

            $this->voiceMailAction
                ->setVoiceMail($this->cfw->getVoiceMailUser())
                ->setPlayBanner(true)
                ->process();

        } else if ($this->cfw->getTargetType() == RouterAction::Extension) {
            // Set as diversion number the user extension
            $this->agi->setRedirecting('from-num,i', $caller->getExtensionNumber());
            $this->agi->setRedirecting('from-tag,i', $caller->getExtensionNumber());
            $this->agi->setRedirecting('from-name',  $caller->getFullName());

            // Route to destination
            $this->routerAction
                ->setRouteType($this->cfw->getTargetType())
                ->setRouteExtension($this->cfw->getExtension())
                ->setRouteVoicemail($this->cfw->getVoiceMailUser())
                ->setRouteExternal($this->cfw->getNumberValueE164())
                ->route();

        } else if ($this->cfw->getTargetType() == RouterAction::External) {
            // Set as diversion number the user Outgoing DDI
            $this->agi->setRedirecting('from-num,i', $caller->getOutgoingDDINumber());
            $this->agi->setRedirecting('from-tag,i', $caller->getExtensionNumber());
            $this->agi->setRedirecting('from-name',  $caller->getFullName());

            // Route to destination
            $this->routerAction
                ->setRouteType($this->cfw->getTargetType())
                ->setRouteExtension($this->cfw->getExtension())
                ->setRouteVoicemail($this->cfw->getVoiceMailUser())
                ->setRouteExternal($this->cfw->getNumberValueE164())
                ->route();
        }

    }

}
