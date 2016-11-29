<?php
namespace Agi\Action;

class RouterAction
{
    private $_actionHistory;

    private $_parent;

    protected $agi;

    protected $_caller;

    protected $_routeType;

    protected $_routeUser;

    protected $_routeExtension;

    protected $_routeIVRCommon;

    protected $_routeIVRCustom;

    protected $_routeVoiceMail;

    protected $_routeHuntGroup;

    protected $_routeExternal;

    protected $_routeFax;

    protected $_routeConference;

    public function __construct($parent)
    {
        // Store parent
        $this->_parent = $parent;

        // Get agi wrapper from parent
        $this->agi = $parent->agi;

        // Get action history so far
        if ($parent instanceOf \Agi\Action\RouterAction) {
            $this->_actionHistory = $parent->_actionHistory;

            // Inherit the caller
            $this->_caller = $parent->_caller;
        } else {
            $this->_actionHistory = array();
        }

        // Add current Action to history
        array_push($this->_actionHistory, $this);

    }

    public function setCaller($caller)
    {
        $this->_caller = $caller;
        return $this;
    }

    public function route()
    {
        // Validate route type
        if (empty($this->_routeType)) {
            $this->agi->error("No configured routeType. This can not be routed.");
            return;
        }

        // Get Action name
        $reflect = new \ReflectionClass($this);

        // Print some output
        $this->agi->verbose("%s -> %s", $reflect->getShortName(), $this->_routeType);
        switch($this->_routeType) {
            case "extension":
                $this->_routeToExtension();
                break;
            case "user":
                $this->_routeToUser();
                break;
            case "number":
                $this->_routeToExternal();
                break;
            case "IVRCommon":
                $this->_routeToIVRCommon();
                break;
            case 'IVRCustom':
                $this->_routeToIVRCustom();
                break;
            case 'voicemail':
                $this->_routeToVoiceMail();
                break;
            case 'huntGroup':
                $this->_routeToHuntGroup();
                break;
            case 'fax':
                $this->_routeToFax();
                break;
            case 'conferenceRoom':
                $this->_routeToConferenceRoom();
                break;
        }
    }

    protected function _routeToExtension()
    {
        $extensionAction = new ExtensionAction($this);
        $extensionAction
            ->setExtension($this->_routeExtension)
            ->process();
    }

    protected function _routeToUser()
    {
        // Handle Call user route
        $userAction = new UserCallAction($this);
        $userAction
            ->setUser($this->_routeUser)
            ->setProcessDialStatus(true)
            ->call();
    }

    protected function _routeToExternal()
    {
        // FIXME Should the company have a default Outgoing DDI ?
        if ($this->_caller instanceof \IvozProvider\Model\Users)
            $this->_caller = $this->_caller->getOutgoingDDI();

        $externalAction = new ExternalDDICallAction($this);
        $externalAction
            ->setDestination($this->_routeExternal)
            ->process();
    }

    protected function _routeToIVRCommon()
    {
        // Handle DTMF IVR route
        $ivrCommonAction = new IVRCommonAction($this);
        $ivrCommonAction
            ->setIVR($this->_routeIVRCommon)
            ->process();
    }

    protected function _routeToIVRCustom()
    {
        // Handle Extension IVR route
        $ivrCustomAction = new IVRCustomAction($this);
        $ivrCustomAction
            ->setIVR($this->_routeIVRCustom)
            ->process();
    }

    protected function _routeToVoiceMail()
    {
        // Handle voicemail route
        $voicemailAction = new VoiceMailAction($this);
        $voicemailAction
            ->setVoiceMail($this->_routeVoiceMail)
            ->process();
    }

    protected function _routeToHuntGroup()
    {
        // Handle huntgroup route
        $huntGroupAction = new HuntGroupAction($this);
        $huntGroupAction
            ->setHuntGroup($this->_routeHuntGroup)
            ->process();
    }

    protected function _routeToFax()
    {
        $faxAction = new FaxCallAction($this);
        $faxAction
            ->setFax($this->_routeFax)
            ->reciveFax();
    }

    protected function _routeToConferenceRoom()
    {
        $conferenceAction = new ConferenceRoomAction($this);
        $conferenceAction
            ->setConferenceRoom($this->_routeConference)
            ->process();
    }

}
