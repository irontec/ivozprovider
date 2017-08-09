<?php
namespace Agi\Action;

class RouterAction
{
    private $_actionHistory;

    private $_parent;

    protected $agi;

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

    protected $_routeFriend;

    protected $_routeQueue;

    protected $_routeRetail;

    public function __construct($parent)
    {
        // Store parent
        $this->_parent = $parent;

        // Get agi wrapper from parent
        $this->agi = $parent->agi;

        // Get action history so far
        if ($parent instanceOf \Agi\Action\RouterAction) {
            $this->_actionHistory = $parent->_actionHistory;
        } else {
            $this->_actionHistory = array();
        }

        // Add current Action to history
        array_push($this->_actionHistory, $this);
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
            case 'friend':
                $this->_routeToFriend();
                break;
            case 'queue':
                $this->_routeToQueue();
                break;
            case 'retailAccount':
                $this->_routeToRetailAccount();
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
        // FIXME One external route to rule them all
        // External Route depends on who is calling
        $caller = $this->agi->getChannelCaller();

        if ($caller instanceof \IvozProvider\Model\Users) {
            // Handle external call route for users
            $externalAction = new ExternalUserCallAction($this);
            $externalAction
                ->setCheckACL(false)
                ->setDestination($this->_routeExternal)
                ->process();
        } else if ($caller instanceof \IvozProvider\Model\Friends) {
            // Handle external call route for users
            $externalAction = new ExternalFriendCallAction($this);
            $externalAction
                ->setCheckACL(false)
                ->setDestination($this->_routeExternal)
                ->process();
        } else {
            // Handle external call route
            $externalAction = new ExternalDDICallAction($this);
            $externalAction
                ->setDestination($this->_routeExternal)
                ->process();
        }


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

    protected function _routeToFriend()
    {
        // Look for the friend that handles this destination
        $caller = $this->agi->getChannelCaller();
        $company = $caller->getCompany();
        $friend = $company->getFriend($this->_routeFriend);

        $friendAction = new FriendCallAction($this);
        $friendAction
            ->setFriend($friend)
            ->setDestination($this->_routeFriend)
            ->call();
    }

    protected function _routeToQueue()
    {
        $queueAction = new QueueAction($this);
        $queueAction
            ->setQueue($this->_routeQueue)
            ->process();
    }

    protected function _routeToRetailAccount()
    {
        $retailAction = new RetailCallAction($this);
        $retailAction
            ->setRetailAccount($this->_routeRetail)
            ->call();
    }

}
