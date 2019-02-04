<?php
namespace Agi\Action;

use Agi\ChannelInfo;
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
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
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
    const Residential    = 'residential';
    const Conditional    = 'conditional';

    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ChannelInfo
     */
    protected $channelInfo;

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
     * @var bool Determine if voicemail must play user-not-available banner
     */
    protected $routeVoicemailBanner;

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
     * @var ResidentialDeviceInterface
     */
    protected $routeResidential;

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
     * @var ExternalNumberAction
     */
    protected $externalNumberCallAction;

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
     * @var ResidentialCallAction
     */
    protected $residentialCallAction;

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
        ChannelInfo $channelInfo,
        ConditionalRouteAction $conditionalRouteAction,
        ConferenceRoomAction $conferenceRoomAction,
        UserCallAction $userCallAction,
        ExtensionAction $extensionAction,
        ExternalNumberAction $externalNumberCallAction,
        FaxReceiveAction $faxReceiveAction,
        FriendCallAction $friendCallAction,
        HuntGroupAction $huntGroupAction,
        IvrAction $ivrAction,
        QueueAction $queueAction,
        ResidentialCallAction $residentialCallAction,
        ServiceAction $serviceAction,
        VoiceMailAction $voiceMailAction
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->conditionalRouteAction = $conditionalRouteAction;
        $this->conferenceRoomAction = $conferenceRoomAction;
        $this->extensionAction = $extensionAction;
        $this->externalNumberCallAction = $externalNumberCallAction;
        $this->faxReceiveAction = $faxReceiveAction;
        $this->friendCallAction = $friendCallAction;
        $this->huntGroupAction = $huntGroupAction;
        $this->userCallAction = $userCallAction;
        $this->ivrAction = $ivrAction;
        $this->queueAction = $queueAction;
        $this->residentialCallAction = $residentialCallAction;
        $this->serviceAction = $serviceAction;
        $this->voiceMailAction = $voiceMailAction;
    }

    public function setRouteType(string $routeType = null)
    {
        $this->routeType = $routeType;
        return $this;
    }

    public function setRouteConditional(ConditionalRouteInterface $routeConditional = null)
    {
        $this->routeConditional = $routeConditional;
        return $this;
    }

    public function setRouteConferenceRoom(ConferenceRoomInterface $routeConferenceRoom = null)
    {
        $this->routeConference = $routeConferenceRoom;
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

    public function setRouteVoicemail(UserInterface $routeVoicemail = null, bool $playBanner = false)
    {
        $this->routeVoiceMail = $routeVoicemail;
        $this->routeVoicemailBanner = $playBanner;
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

    public function setRouteQueue(QueueInterface $routeQueue = null)
    {
        $this->routeQueue = $routeQueue;
        return $this;
    }


    public function setRouteResidential(ResidentialDeviceInterface $routeResidential = null)
    {
        $this->routeResidential = $routeResidential;
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
        switch ($this->routeType) {
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
            case RouterAction::Residential:
                $this->routeToResidentialDevice();
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
        $this->externalNumberCallAction
            ->setDestination($this->routeExternal)
            ->process();
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
            ->setPlayBanner($this->routeVoicemailBanner)
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
        $caller = $this->channelInfo->getChannelCaller();

        /** @var CompanyInterface $company */
        $company = $caller->getCompany();
        $friend = $company->getFriend($this->routeFriendDestination);

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

    protected function routeToResidentialDevice()
    {
        $this->residentialCallAction
            ->setResidentialDevice($this->routeResidential)
            ->process();
    }

    protected function routeService()
    {
        $this->serviceAction
            ->setService($this->routeService)
            ->process();
    }
}
