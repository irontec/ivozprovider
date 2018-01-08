<?php
namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class RouterAction
{
    /**
     * Available route types
     */
    const User           = 'user';
    const Extension      = 'extension';
    const Ivr            = 'ivr';
    const Voicemail      = 'voicemail';
    const External       = 'number';
    const Friend         = 'friend';
    const Service        = 'service';
    const HuntGroup      = 'huntGroup';
    const Fax            = 'fax';
    const ConferenceRoom = 'conferenceRoom';
    const Queue          = 'queue';
    const RetailAccount  = 'retailAccount';
    const Conditional    = 'conditional';

    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var string
     */
    protected $routeType;

    /**
     * @var UserInterface
     */
    protected $routeUser;

    /**
     * @var ExtensionInterface
     */
    protected $routeExtension;

    /**
     * @var IvrInterface
     */
    protected $routeIvr;

    /**
     * @var UserInterface
     */
    protected $routeVoiceMail;

    /**
     * @var HuntGroupInterface
     */
    protected $routeHuntGroup;

    /**
     * @var string
     */
    protected $routeExternal;

    /**
     * @var FaxInterface
     */
    protected $routeFax;

    /**
     * @var ConferenceRoomInterface
     */
    protected $routeConference;

    /**
     * @var FriendInterface
     */
    protected $routeFriend;

    /**
     * @var string
     */
    protected $routeFriendDestination;

    /**
     * @var QueueInterface
     */
    protected $routeQueue;

    /**
     * @var RetailAccountInterface
     */
    protected $routeRetail;

    /**
     * @var ConditionalRouteInterface
     */
    protected $routeConditional;

    /**
     * @var CompanyServiceInterface
     */
    protected $routeService;

    /**
     * @var ConditionalRouteAction
     */
    protected $conditionalRouteAction;

    /**
     * @var ConferenceRoomAction
     */
    protected $conferenceRoomAction;

    /**
     * @var ExtensionAction
     */
    protected $extensionAction;

    /**
     * @var ExternalUserCallAction
     */
    protected $externalUserCallAction;

    /**
     * @var ExternalDdiCallAction
     */
    protected $externalDdiCallAction;

    /**
     * @var ExternalFriendCallAction
     */
    protected $externalFriendCallAction;

    /**
     * @var FaxReceiveAction
     */
    protected $faxReceiveAction;

    /**
     * @var FriendCallAction
     */
    protected $friendCallAction;

    /**
     * @var HuntGroupAction
     */
    protected $huntGroupAction;

    /**
     * @var IvrAction
     */
    protected $ivrAction;

    /**
     * @var QueueAction
     */
    protected $queueAction;

    /**
     * @var UserCallAction
     */
    protected $userCallAction;

    /**
     * @var RetailCallAction
     */
    protected $retailCallAction;

    /**
     * @var ServiceAction
     */
    protected $serviceAction;

    /**
     * @var VoiceMailAction
     */
    protected $voiceMailAction;

    public function __construct(
        Wrapper $agi,
        ConditionalRouteAction $conditionalRouteAction,
        ConferenceRoomAction $conferenceRoomAction,
        UserCallAction $userCallAction,
        ExtensionAction $extensionAction,
        ExternalUserCallAction $externalUserCallAction,
        ExternalDdiCallAction $externalDdiCallAction,
        ExternalFriendCallAction $externalFriendCallAction,
        FaxReceiveAction $faxReceiveAction,
        FriendCallAction $friendCallAction,
        HuntGroupAction $huntGroupAction,
        IvrAction $ivrAction,
        QueueAction $queueAction,
        RetailCallAction $retailCallAction,
        ServiceAction $serviceAction,
        VoiceMailAction $voiceMailAction
    )
    {
        $this->agi = $agi;
        $this->conditionalRouteAction = $conditionalRouteAction;
        $this->conferenceRoomAction = $conferenceRoomAction;
        $this->extensionAction = $extensionAction;
        $this->externalUserCallAction = $externalUserCallAction;
        $this->externalDdiCallAction = $externalDdiCallAction;
        $this->externalFriendCallAction = $externalFriendCallAction;
        $this->faxReceiveAction = $faxReceiveAction;
        $this->friendCallAction = $friendCallAction;
        $this->huntGroupAction = $huntGroupAction;
        $this->userCallAction = $userCallAction;
        $this->ivrAction = $ivrAction;
        $this->queueAction = $queueAction;
        $this->retailCallAction = $retailCallAction;
        $this->serviceAction = $serviceAction;
        $this->voiceMailAction = $voiceMailAction;
    }

    public function setRouteType(string $routeType)
    {
        $this->routeType = $routeType;
        return $this;
    }

    public function setRouteConditional(ConditionalRouteInterface $routeConditional  = null)
    {
        $this->routeConditional = $routeConditional;
        return $this;
    }

    public function setRouteConferenceRoom(ConferenceRoomInterface $routeConfereceRoom  = null)
    {
        $this->routeConference = $routeConfereceRoom;
        return $this;
    }

    public function setRouteUser(UserInterface $routeUser = null)
    {
        $this->routeUser = $routeUser;
        return $this;
    }

    public function setRouteExtension(ExtensionInterface $routeExtension = null)
    {
        $this->routeExtension = $routeExtension;
        return $this;
    }

    public function setRouteExternal(string $routeExternal = null)
    {
        $this->routeExternal = $routeExternal;
        return $this;
    }

    public function setRouteIvr(IvrInterface $routeIvr = null)
    {
        $this->routeIvr = $routeIvr;
        return $this;
    }

    public function setRouteHuntGroup(HuntGroupInterface $routeHuntGroup = null)
    {
        $this->routeHuntGroup = $routeHuntGroup;
        return $this;
    }

    public function setRouteVoicemail(UserInterface $routeVoicemail = null)
    {
        $this->routeVoiceMail = $routeVoicemail;
        return $this;
    }

    public function setRouteService(CompanyServiceInterface $routeService = null)
    {
        $this->routeService = $routeService;
        return $this;
    }

    public function setRouteFriend(FriendInterface $routeFriend = null)
    {
        $this->routeFriend = $routeFriend;
        return $this;
    }

    public function setRouteFriendDestination(string $routeFrienDestination = null)
    {
        $this->routeFriendDestination = $routeFrienDestination;
        return $this;
    }

    public function setRouteQueue(QueueInterface $routeQueue  = null)
    {
        $this->routeQueue = $routeQueue;
        return $this;
    }


    public function setRouteRetail(RetailAccountInterface $routeRetail = null)
    {
        $this->routeRetail = $routeRetail;
        return $this;
    }

    public function setRouteFax(FaxInterface $routeFax = null)
    {
        $this->routeFax = $routeFax;
        return $this;
    }

    public function route()
    {
        // Handle based on configured route type
        switch($this->routeType) {
            case RouterAction::User:
                $this->routeToUser();
                break;
            case RouterAction::Extension:
                $this->routeToExtension();
                break;
            case RouterAction::External:
                $this->routeToExternal();
                break;
            case RouterAction::Ivr:
                $this->routeToIVR();
                break;
            case RouterAction::Voicemail:
                $this->routeToVoiceMail();
                break;
            case RouterAction::HuntGroup:
                $this->routeToHuntGroup();
                break;
            case RouterAction::Fax:
                $this->routeToFax();
                break;
            case RouterAction::ConferenceRoom:
                $this->routeToConferenceRoom();
                break;
            case RouterAction::Friend:
                $this->routeToFriend();
                break;
            case RouterAction::Queue:
                $this->routeToQueue();
                break;
            case RouterAction::RetailAccount:
                $this->routeToRetailAccount();
                break;
            case RouterAction::Conditional:
                $this->routeToConditionalRoute();
                break;
            case RouterAction::Service:
                $this->routeService();
                break;
        }
    }

    protected function routeToUser()
    {
        $this->userCallAction
            ->setUser($this->routeUser)
            ->process();
    }

    protected function routeToExtension()
    {
        $this->extensionAction
            ->setExtension($this->routeExtension)
            ->process();
    }

    protected function routeToExternal()
    {
        // External Route depends on who is calling
        $caller = $this->agi->getChannelCaller();

        if ($caller instanceof UserInterface) {
            // Handle external call route for users
            $this->externalUserCallAction
                ->setCheckACL(false)
                ->setDestination($this->routeExternal)
                ->process();

        } else if ($caller instanceof FriendInterface) {
            // Handle external call route for users
            $this->externalFriendCallAction
                ->setFriend($caller)
                ->setCheckACL(false)
                ->setDestination($this->routeExternal)
                ->process();

        } else {
            // Handle external call route
            $this->externalDdiCallAction
                ->setDestination($this->routeExternal)
                ->process();
        }
    }

    protected function routeToIvr()
    {
        $this->ivrAction
            ->setIVR($this->routeIvr)
            ->process();
    }

    protected function routeToQueue()
    {
        $this->queueAction
            ->setQueue($this->routeQueue)
            ->process();
    }

    protected function routeToVoiceMail()
    {
        $this->voiceMailAction
            ->setVoiceMail($this->routeVoiceMail)
            ->process();
    }

    protected function routeToHuntGroup()
    {
        $this->huntGroupAction
            ->setHuntGroup($this->routeHuntGroup)
            ->process();
    }

    protected function routeToFax()
    {
        $this->faxReceiveAction
            ->setFax($this->routeFax)
            ->process();
    }

    protected function routeToConferenceRoom()
    {
        $this->conferenceRoomAction
            ->setConferenceRoom($this->routeConference)
            ->process();
    }

    protected function routeToFriend()
    {
        // Look for the friend that handles this destination
        $caller = $this->agi->getChannelCaller();

        /** @var CompanyInterface $company */
        $company = $caller->getCompany();
        $friend = $company->getFriend($this->routeFriend);

        $this->friendCallAction
            ->setFriend($friend)
            ->setDestination($this->routeFriend)
            ->process();
    }

    protected function routeToConditionalRoute()
    {
        $this->conditionalRouteAction
            ->setConditionalRoute($this->routeConditional)
            ->process();
    }

    protected function routeToRetailAccount()
    {
        $this->retailCallAction
            ->setRetailAccount($this->routeRetail)
            ->process();
    }

    protected function routeService()
    {
        $this->serviceAction
            ->setService($this->routeService)
            ->process();
    }

}
