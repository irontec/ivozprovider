<?php
require_once("BaseController.php");
use IvozProvider\Mapper\Sql as Mapper;
use Agi\Action\DDIAction;
use Agi\Action\ExtensionAction;
use Agi\Action\UserCallAction;
use Agi\Action\HuntGroupAction;
use Agi\Action\IVRAction;
use Agi\Action\ServiceAction;
use Agi\Action\FriendCallAction;
use Agi\Action\ExternalUserCallAction;
use Agi\Action\ExternalFriendCallAction;
use Agi\Action\ExternalRetailCallAction;
use Agi\Action\QueueAction;

/**
 * @brief Controller for Incoming and Outgoing calls
 *
 * This controllers is invoked from different contexts of dialplan and routes
 * the call based on configuretion
 *
 * Following actions are defined in this controller
 * - incoming: Handle incoming calls from external numbers
 * - outgoing: Handle outgoing calls from registered users
 * - forwards: Handle channel redirections and transfers
 * - dialstatus: Handle post-call user call forwards
 *
 * @package AGI
 * @subpackage CallsController
 * @author Gaizka Elexpe <gaizka@irontec.com>
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class CallsController extends BaseController
{
    /**
     * @brief Incomming from from external numbers
     */
    public function trunksAction ()
    {
        // Get Dialed number
        $exten = $this->agi->getExtension();

        // Check if incoming DDI is for us
        $DDIMapper = new Mapper\DDIs();
        $ddi = $DDIMapper->findOneByField("DDIE164", $exten);
        if (empty($ddi)) {
            $this->agi->error("DDI %s not found in database.", $exten);
            return;
        }

        // Store Original E164 Number for further transformations
        $this->agi->setOrigCallerIdNum($this->agi->getCallerIdNum());

        // Mark this call as external
        $this->agi->setCallType("external");

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("__CALL_ID", $this->agi->getCallId());

        // Get company MusicClass: company, Generic or default
        $company = $ddi->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());
        $this->agi->setVariable("CHANNEL(language)", $ddi->getLanguageCode());

        // Check company On demand record code
        if ($company->getOnDemandRecord()) {
            $this->agi->setVariable("FEATUREMAP(automixmon)", $company->getOnDemandRecordDTMFs());
        }

        // Set DDI as the caller
        $this->setChannelOwner($ddi);

        // Process this DDI
        $ddiAction = new DDIAction($this);
        $ddiAction
            ->setCaller($ddi)
            ->setDDI($ddi)
            ->process();
    }

    /**
     * @brief Outgoing calls from terminals to Extensions, Services o World
     */
    public function usersAction ()
    {
        /**
         * Determine who is placing this call:
         * - SIPTRANSFER: set by asterisk on blind transfers
         * - Diversion:   set by asterisk on 302 Moved SIP Message
         * - Endpoint:    set by asterisk on matching endpoint
         */
        if ($this->agi->getVariable("SIPTRANSFER")) {
            // Asterisk stores the Refered-By header of the transferer
            $transfererURI = $this->agi->extractURI($this->agi->getVariable("SIPREFERREDBYHDR"), "uri");
            $aorMapper = new Mapper\AstPsAors;
            // Get the endpoint name matching the referer contact
            $endpointName = $aorMapper->getSorceryByContact($transfererURI);
        } else if ($forwarder = $this->agi->getRedirecting('from-num')) {
            // 302 Moved here caller. The variable MUST store the last dialed endpoint
            $endpointName = $this->agi->getVariable("DIAL_ENDPOINT");
            // Restore original number presentation to E.164
            $this->agi->setCallerIdNum($this->agi->getOrigCallerIdNum());
        } else {
            $endpointName = $this->agi->getEndpoint();
        }

        // Do we get who is actually calling?
        if (empty($endpointName)) {
            $this->agi->error("Call without valid endpointName. Dropping.");
            return;
        }

        // Get caller endpoitn model
        $endpointsMapper = new Mapper\AstPsEndpoints();
        $endpoint = $endpointsMapper->findOneByField("sorcery_id", $endpointName);
        if (empty($endpoint)) {
            $this->agi->error("Endpoint %s not found.", $endpointName);
            return;
        }

        $terminal = $endpoint->getTerminal();
        if (empty($terminal)) {
            $this->agi->error("No terminal found for endpoint %s.", $endpointName);
            return;
        }

        // Get caller user
        $user = $terminal->getUser();
        if (empty($user)) {
            $this->agi->error("Terminal %s has no user.", $terminal->getId());
            return;
        }

        // Get caller extension
        $extension = $user->getExtension();
        if (empty($extension)) {
            $this->agi->error("User %s has no extension.", $user->getId());
            return;
        }

        // Set Company/Brand/Generic Music class
        $company = $user->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Check User's permission to does this call
        $exten = $this->agi->getExtension();

        // Mark this call as generated from user
        $this->agi->setCallType("internal");

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("__CALL_ID", $this->agi->getCallId());

        // Set user language and music
        $this->agi->setVariable("CHANNEL(language)", $user->getLanguageCode());
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());

        // Check company On demand record code
        if ($company->getOnDemandRecord()) {
            $this->agi->setVariable("FEATUREMAP(automixmon)", $company->getOnDemandRecordDTMFs());
        }

        // Remove any Diversion header generated by Terminals (they will be added if required later)
        if ($this->agi->getRedirecting('count')) {
            $this->agi->setRedirecting('count', 0);
        }

        // If this call is being BlindXfered, update Referred-By header
        if (isset($transfererURI) && !empty($transfererURI)) {
            $transfererURI = str_replace($endpointName, $extension->getNumber(), $transfererURI);
            $this->agi->setVariable("__SIPREFERREDBYHDR", $transfererURI);
        }

        // Set User as the caller
        $this->setChannelOwner($user);

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from \e[0;32m%s [user%d]\e[0;93m to number %s",
                        $user->getFullName(), $user->getId(), $exten);

        // Check if this extension starts with '*' code
        if (strpos($exten, '*') === 0) {
            if (($service = $company->getService($exten))) {
                $this->agi->verbose("Number %s belongs to a company service [service%d].",
                                $exten, $service->getId());

                // Handle service code
                $serviceAction = new ServiceAction($this);
                $serviceAction
                    ->setCaller($user)
                    ->setService($service)
                    ->process();

            } else {
                // Decline this call if not matching service is found
                $this->agi->verbose("Invalid Service code %s for comany %d", $exten, $company->getId());
                $this->agi->hangup();
            }

        // Check if this is an extension call
        } elseif (($dstExtension = $company->getExtension($exten))) {
            $this->agi->verbose("Number %s belongs to a Company Extension [extension%d].",
                            $exten, $dstExtension->getId());

            // Update Diversion Header with User Extension Number
            if (isset($forwarder) && !empty($forwarder)) {
                $this->agi->setRedirecting('from-num,i', $extension->getNumber());
                $this->agi->setRedirecting('count,i', 1);
            }

            // Handle extension
            $extensionAction = new ExtensionAction($this);
            $extensionAction
                ->setCaller($user)
                ->setExtension($dstExtension)
                ->process();

        // Check if this number matches one of friendly trunks patterns
        } else if (($friend = $company->getFriend($exten))) {
            $this->agi->verbose("Number %s is handled by friendly trunk.", $exten);

            // Update Diversion Header with User Extension Number
            if (isset($forwarder) && !empty($forwarder)) {
                $this->agi->setRedirecting('from-num,i', $extension->getNumber());
                $this->agi->setRedirecting('count,i', 1);
            }

            // Handle call through friendly trunk
            $friendAction = new FriendCallAction($this);
            $friendAction
                ->setCaller($user)
                ->setFriend($friend)
                ->setDestination($exten)
                ->call();

        // This number don't belong to IvozProvider
        } else {
            $this->agi->verbose("Number %s is handled as external number.", $exten);

            // Update Diversion Header with User Outgoing DDI
            if (isset($forwarder) && !empty($forwarder)) {
                $this->agi->setRedirecting('from-name,i', $user->getFullName());
                $this->agi->setRedirecting('from-num,i',  $user->getOutgoingDDINumber());
                $this->agi->setRedirecting('from-tag,i',  $user->getExtensionNumber());
                $this->agi->setRedirecting('count,i', 1);
            }

            // Otherwise, handle this call as external
            $externalCallAction = new ExternalUserCallAction($this);
            $externalCallAction
                ->setCaller($user)
                ->setDestination($exten)
                ->process();
        }
    }

    /**
     * @brief Process User after call status
     */
    public function userstatusAction ()
    {
        // Get the called endpoint to check postcall actions
        $endpointName = $this->agi->getVariable("DIAL_ENDPOINT");
        $endpointsMapper = new Mapper\AstPsEndpoints();
        $endpoint = $endpointsMapper->findOneByField("sorcery_id", $endpointName);

        if (empty($endpoint)) {
            $this->agi->error("No matching endpoint found with name %s", $endpointName);
            return;
        }

        $terminal = $endpoint->getTerminal();
        if (empty($terminal)) {
            $this->agi->error("Terminal %s not found in database. (BUG?)", $endpointName);
            return;
        }

        // Get user from the terminal.
        $user = $terminal->getUser();
        if (empty($user)) {
            $this->agi->error("Terminal %s has no user (BUG?).", $endpointName);
            return;
        }

        // ProcessDialStatus
        $userAction = new UserCallAction($this);
        $userAction
            ->setCaller($this->getChannelOwner())
            ->setUser($user)
            ->processDialStatus();
    }

    /**
     * @brief Outgoing calls from queues
     */
    public function queuesAction()
    {
        $companyId = $this->agi->getVariable("COMPANYID");
        $companyMapper = new Mapper\Companies();
        $company = $companyMapper->find($companyId);

        if (empty($company)) {
            $this->agi->error("No company found with id %d (BUG?).", $companyId);
            return;
        }

        $queueMemberId = $this->agi->getExtension();
        $queueMembersMapper = new Mapper\QueueMembers();
        $queueMember = $queueMembersMapper->find($queueMemberId);
        if (empty($queueMember)) {
           $this->agi->error("Queue member with id %d does not exists.", $queueMemberId);
        }

        $user = $queueMember->getUser();
        if (empty($user)) {
            $this->agi->error("No user found for queue member %d", $queueMemberId);
            return;
        }

        $endpoint = $user->getEndpoint();
        if (empty($endpoint)) {
            $this->agi->error("User %d has no endpoint associated", $user->getId());
            return;
        }

        $this->agi->setVariable("DIAL_OPTS", "ic");
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $endpoint->getSorceryId());
    }

    /**
     * @brief After Queue process
     */
    public function queuestatusAction()
    {
        $queueId = $this->agi->getVariable("QUEUE_ID");
        $queueMapper = new Mapper\Queues();
        $queue = $queueMapper->find($queueId);

        // Process Queue Timeout
        $queueAction = new QueueAction($this);
        $queueAction
            ->setCaller($this->getChannelOwner())
            ->setQueue($queue);


        switch($this->agi->getVariable("QUEUESTATUS")) {
            case 'TIMEOUT':
                $queueAction->processTimeout();
                break;
            case 'FULL':
                $queueAction->processFull();
                break;
        }
    }

    /**
     * @brief Outgoing calls from friends
     */
    public function friendsAction ()
    {
        // Get identified Enpoint name
        $endpointName = $this->agi->getEndpoint();

        // Do we get who is actually calling?
        if (empty($endpointName)) {
            $this->agi->error("Call without valid endpointName. Dropping.");
            return;
        }

        // Get caller endpoitn model
        $endpointsMapper = new Mapper\AstPsEndpoints();
        $endpoint = $endpointsMapper->findOneByField("sorcery_id", $endpointName);
        if (empty($endpoint)) {
            $this->agi->error("Endpoint %s not found.", $endpointName);
            return;
        }

        $friend = $endpoint->getFriend();
        if (empty($friend)) {
            $this->agi->error("No friend found for endpoint %s.", $endpointName);
            return;
        }

        // Set Company/Brand/Generic Music class
        $company = $friend->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Check User's permission to does this call
        $exten = $this->agi->getExtension();

        // Mark this call as generated from user
        $this->agi->setCallType("internal");

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set user language and music
        $this->agi->setVariable("CHANNEL(language)",   $friend->getLanguageCode());
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());

        // Set User as the caller
        $this->setChannelOwner($friend);

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from \e[0;36m%s [friend%d]\e[0;93m to number %s",
                        $friend->getName(), $friend->getId(), $exten);

        // Check if this is an extension call
        if (($dstExtension = $company->getExtension($exten))) {
            $this->agi->verbose("Number %s belongs to a Company Extension [extension%d].",
                            $exten, $dstExtension->getId());

            // Handle extension
            $extensionAction = new ExtensionAction($this);
            $extensionAction
                ->setCaller($friend)
                ->setExtension($dstExtension)
                ->process();

        } else if (($outfriend = $company->getFriend($exten))) {
            $this->agi->verbose("Number %s is handled by friendly trunk.", $exten);

            // Handle call through friendly trunk
            $friendAction = new FriendCallAction($this);
            $friendAction
                ->setCaller($friend)
                ->setFriend($outfriend)
                ->setDestination($exten)
                ->call();

        // This number don't belong to IvozProvider
        } else {
            $this->agi->verbose("Number %s is handled as external number.", $exten);

            // Otherwise, handle this call as external
            $externalCallAction = new ExternalFriendCallAction($this);
            $externalCallAction
                ->setCaller($friend)
                ->setDestination($exten)
                ->process();
        }
    }

    /**
     * @brief Outgoing calls from friends
     */
    public function retailAction ()
    {
        // Get identified Enpoint name
        $endpointName = $this->agi->getEndpoint();

        // Do we get who is actually calling?
        if (empty($endpointName)) {
            $this->agi->error("Call without valid endpointName. Dropping.");
            return;
        }

        // Get caller endpoint model
        $endpointsMapper = new Mapper\AstPsEndpoints();
        $endpoint = $endpointsMapper->findOneByField("sorcery_id", $endpointName);
        if (empty($endpoint)) {
            $this->agi->error("Endpoint %s not found.", $endpointName);
            return;
        }

        $retail = $endpoint->getRetailAccount();
        if (is_null($retail)) {
            $this->agi->error("No retail found for endpoint %s.", $endpointName);
            return;
        }

        // Set Company/Brand/Generic Music class
        $company = $retail->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $this->setChannelOwner($retail);

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from Retail account \e[0;36m%s [retail%d]\e[0;93m to number %s",
                        $retail->getName(), $retail->getId(), $exten);
        // Otherwise, handle this call as external
        $externalCallAction = new ExternalRetailCallAction($this);
        $externalCallAction
            ->setCaller($retail)
            ->setDestination($exten)
            ->process();
    }

    /**
     * @brief Incoming calls to conference
     */
    public function conferencesAction()
    {
        $conferenceId = $this->agi->getExtension();
        $conferenceMapper = new Mapper\ConferenceRooms();
        $conference = $conferenceMapper->find($conferenceId);
        if (empty($conference)) {
            $this->agi->error("Conference %d not found in database", $conferenceId);
            return;
        }

        // Get company from conference
        $company = $conference->getCompany();

        // Set desired channel language
        $this->agi->setVariable("CHANNEL(language)", $this->agi->getSIPHeader("X-Info-Conf-Lang"));

        // Set user language and music
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());

        // Check if conference requires pin
        if ($conference->getPinProtected()) {
           $this->agi->setConferenceSetting('user,pin', $conference->getPinCode());
        }

        // Check if conference has max members
        if ($conference->getMaxMembers()) {
            $this->agi->setConferenceSetting('bridge,max_members', $conference->getMaxMembers());
        }

        // Enable video support
        $this->agi->setConferenceSetting('bridge,video_mode', 'follow_talker');
    }

    /**
     * @brief Process IVR after call status
     */
    public function ivrstatusAction ()
    {
        $dialStatus = $this->agi->getVariable("DIALSTATUS");

        // Noone picked up
        if ($dialStatus == "NOANSWER") {
            $ivrId = $this->agi->getVariable("IVRID");

            // Get IVRCommon..
            $ivrCommonMapper = new Mapper\IVRCommon();
            $ivr = $ivrCommonMapper->find($ivrId);

            // Or IVRcustom...
            if (empty($ivr)) {
                $ivrCustomMapper = new Mapper\IVRCustom();
                $ivr = $ivrCustomMapper->find($ivrId);
            }

            // Process NoAnswer handler
            $ivrAction = new IVRAction($this);
            $ivrAction
                ->setCaller($this->getChannelOwner())
                ->setIvr($ivr)
                ->processTimeout();
        }
    }

    /**
     * @brief Call a user from a Huntgroup
     */
    public  function hgcalluserAction()
    {
        // Get running Huntgroup
        $huntgroupId = $this->agi->getVariable("HG_ID");
        $huntgroupMapper = new Mapper\HuntGroups();
        $huntgroup = $huntgroupMapper->find($huntgroupId);

        // Continue processing
        $hungroupAction = new HuntGroupAction($this);
        $hungroupAction
            ->setCaller($this->getChannelOwner())
            ->setHuntGroup($huntgroup)
            ->call();
    }

    /**
     * @brief Process Huntgroup after call status
     */
    public function hgstatusAction ()
    {
        // Get running Huntgroup
        $huntgroupId = $this->agi->getVariable("HG_ID");
        $huntgroupMapper = new Mapper\HuntGroups();
        $huntgroup = $huntgroupMapper->find($huntgroupId);

        // Continue processing
        $hungroupAction = new HuntGroupAction($this);
        $hungroupAction
            ->setCaller($this->getChannelOwner())
            ->setHuntGroup($huntgroup)
            ->processHuntgroupStatus();
    }

    /**
     * @brief Add SIP Headers for proxies
     */
    public function addheadersAction()
    {
        $companyId = $this->agi->getVariable("COMPANYID");
        $companyMapper = new Mapper\Companies();
        $company = $companyMapper->find($companyId);

        // Add headers for Friendly Kamailio  Proxy;-))
        $this->agi->setSIPHeader("X-Call-Id",            $this->agi->getVariable("CALL_ID"));
        $this->agi->setSIPHeader("X-Info-BrandId",       $company->getBrandId());
        $this->agi->setSIPHeader("X-Info-CompanyId",     $company->getId());
        $this->agi->setSIPHeader("X-Info-CompanyName",   $company->getName());
        $this->agi->setSIPHeader("X-Info-MediaRelaySet", $company->getMediaRelaySetsId());

        // Get Calle data, take if from called endpoint
        $endpointsMapper = new Mapper\AstPsEndpoints();
        $endpoint = $endpointsMapper->findOneByField("sorcery_id", $this->agi->getEndpoint());
        if (!empty($endpoint)) {
            $terminal = $endpoint->getTerminal();
            if (!is_null($terminal)) {
                $this->agi->setSIPHeader("X-Info-Callee", $terminal->getUser()->getExtensionNumber());
                $this->agi->setSIPHeader("X-Info-MaxCalls", $terminal->getUser()->getMaxCalls());
            }
            $friend = $endpoint->getFriend();
            if (!is_null($friend)) {
                $exten = $this->agi->getExtension();
                $this->agi->setSIPHeader("X-Info-Callee", $exten);
                $this->agi->setSIPHeader("X-Info-Friend", $friend->getRequestURI($exten));
                $this->agi->setSIPHeader("X-Info-MaxCalls", 0);
            }
            $retail = $endpoint->getRetailAccount();
            if (!is_null($retail)) {
                $exten = $this->agi->getExtension();
                $this->agi->setSIPHeader("X-Info-Callee", $exten);
                $this->agi->setSIPHeader("X-Info-Retail", $retail->getRequestURI($exten));
                $this->agi->setSIPHeader("X-Info-MaxCalls", 0);

            }

            // Set on-demand recording header (only for proxyusers)
            if ($company->getOnDemandRecord()) {
                $this->agi->setSIPHeader("X-Info-RecordCode", $company->getOnDemandRecordCode());
                $this->agi->setVariable("FEATUREMAP(automixmon)", $company->getOnDemandRecordDTMFs());
            }

        } else {
            $this->agi->setSIPHeader("X-Info-CompanyDomain", $company->getDomain());
            $this->agi->setSIPHeader("X-Info-MaxCalls",  $company->getExternalMaxCalls());

            // Set special headers for Fax outgoing calls
            if ($this->agi->getVariable("FAXFILE_ID")) {
                $this->agi->setSIPHeader("X-Info-Special", "fax");
            }
        }

        // Set Special header for Forwarding
        if ($this->agi->getRedirecting('from-tag')) {
            $this->agi->setSIPHeader("X-Info-ForwardExt", $this->agi->getRedirecting('from-tag'));
        }

        // Set recording header
        if ($this->agi->getVariable("RECORD")) {
            $this->agi->setSIPHeader("X-Info-Record", $this->agi->getVariable("RECORD"));
        }

        // Request intra DDI bounce
        if ($this->agi->getVariable("BOUNCEME")) {
            $this->agi->setSIPHeader("X-Info-BounceMe", $this->agi->getVariable("BOUNCEME"));
        }

        // Set pickups group on outgoing channels
        if ($this->agi->getVariable("CHANNEL(pickupgroup)")) {
            $this->agi->setVariable("CHANNEL(callgroup)", $this->agi->getVariable("CHANNEL(pickupgroup)"));
        }

        // Set conference options
        if ($this->agi->getVariable("CONFERENCE_ID")) {
            $this->agi->setSIPHeader("X-Info-Conf", $this->agi->getVariable("CONFERENCE_ID"));
            $this->agi->setSIPHeader("X-Info-Conf-Lang", $this->agi->getVariable("CONFERENCE_LANG"));
        }
    }

    public function updatelineAction()
    {
        $userId = $this->agi->getVariable("USERID");
        if ($userId) {
            $userMapper = new Mapper\Users();
            $user = $userMapper->find($userId);
            $e164exten = $this->agi->getExtension();
            $exten = $user->E164toPreferred($e164exten);
            $this->agi->setConnectedLine('num,i', $exten);
            $this->agi->setConnectedLine('name', '');
        }
    }

    private function setChannelOwner($owner)
    {
        if ($owner instanceof \IvozProvider\Model\Raw\Users)
            $this->agi->setVariable("CALLER_TYPE", "USER");
        if ($owner instanceof \IvozProvider\Model\Raw\DDIs)
            $this->agi->setVariable("CALLER_TYPE", "DDI");
        if ($owner instanceof \IvozProvider\Model\Raw\Friends)
            $this->agi->setVariable("CALLER_TYPE", "FRIEND");
        if ($owner instanceof \IvozProvider\Model\Raw\RetailAccounts)
            $this->agi->setVariable("CALLER_TYPE", "RETAIL");
        $this->agi->setVariable("CALLER_ID", $owner->getId());
    }

    private function getChannelOwner()
    {
        switch($this->agi->getVariable("CALLER_TYPE")) {
            case "USER":
                $mapper = new Mapper\Users();
                break;
            case "DDI":
                $mapper = new Mapper\DDIs();
                break;
            case "FRIEND":
                $mapper = new Mapper\Friends();
                break;
            case "RETAIL":
                $mapper = new Mapper\RetailAccounts();
                break;
            default: return null;
        }

        return $mapper->find($this->agi->getVariable("CALLER_ID"));
    }

}
