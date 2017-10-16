<?php
namespace Agi\Action;

use Assert\Assertion;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

class CallForwardAction extends RouterAction
{
    /**
     * Max allowed Call forwards from a channel
     *
     * @var int
     */
    protected $_maxRedirections = 5;

    /**
     * @var CallForwardSettingInterface
     */
    protected $_cfw;

    public function setCallForward($cfw)
    {
        $this->_cfw = $cfw;
        return $this;
    }

    public function process()
    {
        $cfw = $this->_cfw;
        Assertion::notNull(
            $cfw,
            "CallForward is not properly defined. Check configuration."
        );

        // Some CLI information
        $this->agi->notice("Processing %s call forward", $cfw->getCallForwardType());

        /**
         * Set Diversion reason based on current Call Forward settings
         *
         * https://wiki.asterisk.org/wiki/display/AST/Function_REDIRECTING
         */
        switch ($cfw->getCallForwardType()) {
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
        $this->agi->setChannelCaller($cfw->getUser());

        // Route to destination
        $this->_routeType       = $cfw->getTargetType();
        $this->_routeExtension  = $cfw->getExtension();
        $this->_routeVoiceMail  = $cfw->getVoiceMailUser();
        $this->_routeExternal   = $cfw->getNumberValue();
        $this->route();
    }

    protected function _routeToVoiceMail()
    {
        // Get Call forward user
        $caller = $this->agi->getChannelCaller();

        // Set as diversion number the user extension
        $this->agi->setRedirecting('from-num,i', $caller->getExtensionNumber());
        $this->agi->setRedirecting('from-tag,i', $caller->getExtensionNumber());
        $this->agi->setRedirecting('from-name',  $caller->getFullName());

        // Enable unavailable user banner
        $voicemailAction = new VoiceMailAction($this);
        $voicemailAction
            ->setPlayBanner(true)
            ->setVoiceMail($this->_routeVoiceMail)
            ->process();
    }

    protected function _routeToExtension()
    {
        // Get Call forward user
        $caller = $this->agi->getChannelCaller();

        // Set as diversion number the user extension
         $this->agi->setRedirecting('from-num,i', $caller->getExtensionNumber());
         $this->agi->setRedirecting('from-tag,i', $caller->getExtensionNumber());
         $this->agi->setRedirecting('from-name',  $caller->getFullName());

        // Use default route function
        parent::_routeToExtension();
    }

    protected function _routeToExternal()
    {
        // Get Call forward user
        $caller = $this->agi->getChannelCaller();

        // Set as diversion number the user Outgoing DDI
        $this->agi->setRedirecting('from-num,i', $caller->getOutgoingDDINumber());
        $this->agi->setRedirecting('from-tag,i', $caller->getExtensionNumber());
        $this->agi->setRedirecting('from-name',  $caller->getFullName());


        $externalAction = new ExternalUserCallAction($this);
        $externalAction
            ->setDestination($this->_routeExternal)
            ->process();
    }
}
