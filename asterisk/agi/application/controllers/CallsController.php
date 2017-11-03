<?php
require_once("BaseController.php");

use Agi\Action\DDIAction;
use Agi\Action\ExtensionAction;
use Agi\Action\ExternalFriendCallAction;
use Agi\Action\ExternalRetailCallAction;
use Agi\Action\ExternalUserCallAction;
use Agi\Action\FriendCallAction;
use Agi\Action\HuntGroupAction;
use Agi\Action\IVRAction;
use Agi\Action\QueueAction;
use Agi\Action\ServiceAction;
use Agi\Action\UserCallAction;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;

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
    public function testAction()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiRepository $ddiRepository */
        $ddiRepository = $em->getRepository('\Ivoz\Provider\Domain\Model\Ddi\Ddi');
        $ddiRepository->find(20);
        return 0;
    }

    /**
     * @brief Incomming from from external numbers
     */
    public function trunksAction ()
    {
        // Get Dialed number
        $exten = $this->agi->getExtension();

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiRepository $ddiRepository */
        $ddiRepository = $em->getRepository(Ddi::class);

        /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi */
        $ddi = $ddiRepository->findOneBy([
            "ddie164" => $exten
        ]);

        // Check if incoming DDI is for us
        Assertion::notNull(
            $ddi,
            sprintf("DDI %s not found in database.", $exten)
        );

        // Mark this call as external
        $this->agi->setCallType("external");

        // Remove any Diversion header from external calls
        if ($this->agi->getRedirecting('count')) {
            $this->agi->setRedirecting('count', 0);
        }

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
        $this->agi->setChannelCaller($ddi);

        // Process this DDI
        $ddiAction = new DDIAction($this);
        $ddiAction
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

        /**
         * Blind Transfer from User's terminal
         */
        if ($this->agi->getVariable("SIPTRANSFER")) {
            // Asterisk stores the Refered-By header of the transferer
            $transfererHdr = $this->agi->getVariable("SIPREFERREDBYHDR");

            $transfererURI = $this->agi->extractURI($transfererHdr, "uri");
            $transfererNum = $this->agi->extractURI($transfererHdr, "num");
            $transfererDomain = $this->agi->extractURI($transfererHdr, "domain");

            $endpointName = $this->getEndpointNameFromContact($transfererNum, $transfererDomain);

            // Transferer is the new caller
            $user = $this->getUserFromEndpoint($endpointName);
            $this->agi->setChannelCaller($user);

            // Set Caller extension in Referred header
            $transfererURI = str_replace($endpointName, $user->getExtensionNumber(), $transfererURI);
            $this->agi->setVariable("__SIPREFERREDBYHDR", $transfererURI);

        /**
         * Redirection from User's terminal - 302 Moved
         */
        } else if ($forwarder = $this->agi->getRedirecting('from-num')) {
            // 302 Moved here caller. The variable MUST store the last dialed endpoint
            $endpointName = $this->agi->getVariable("DIAL_ENDPOINT");

            // Forwarder is the new caller
            $user = $this->getUserFromEndpoint($endpointName);
            $this->agi->setChannelCaller($user);

            // Remove any Diversion header generated by Terminals (they will be added if required later)
            $this->agi->setRedirecting('count', 0);

        /**
         * Normal call from User's terminal
         */
        } else {
            // Get endpoint name from channel
            $endpointName = $this->agi->getEndpoint();

            $user = $this->getUserFromEndpoint($endpointName);
            $this->agi->setChannelCaller($user);
            $this->agi->setChannelOrigin($user);
        }

        // Set Company/Brand/Generic Music class
        $company = $user->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

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

        // Check User's permission to does this call
        $exten = $this->agi->getExtension();

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
                $this->agi->setRedirecting('from-num,i', $user->getExtensionNumber());
                $this->agi->setRedirecting('from-tag,i', $user->getExtensionNumber());
                $this->agi->setRedirecting('count,i', 1);
            }

            // Handle extension
            $extensionAction = new ExtensionAction($this);
            $extensionAction
                ->setExtension($dstExtension)
                ->process();

        // Check if this number matches one of friendly trunks patterns
        } else if (($friend = $company->getFriend($exten))) {
            $this->agi->verbose("Number %s is handled by friendly trunk.", $exten);

            // Update Diversion Header with User Extension Number
            if (isset($forwarder) && !empty($forwarder)) {
                $this->agi->setRedirecting('from-num,i', $user->getExtensionNumber());
                $this->agi->setRedirecting('from-tag,i', $user->getExtensionNumber());
                $this->agi->setRedirecting('count,i', 1);
            }

            // Handle call through friendly trunk
            $friendAction = new FriendCallAction($this);
            $friendAction
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
        // Get user from the endpoint.
        $user = $this->getUserFromEndpoint($endpointName);

        // ProcessDialStatus
        $userAction = new UserCallAction($this);
        $userAction
            ->setUser($user)
            ->processDialStatus();
    }

    /**
     * @brief Outgoing calls from queues
     */
    public function queuesAction()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyRepository $companyRepository */
        $companyRepository = $em->getRepository('\Ivoz\Provider\Domain\Model\Company\Company');

        // Get company from channel variables
        $companyId = $this->agi->getVariable("COMPANYID");

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company */
        $company = $companyRepository->find($companyId);

        /** @var \Ivoz\Ast\Domain\Model\QueueMember\QueueMemberRepository $queueMemberRepository */
        $queueMemberRepository = $em->getRepository('\Ivoz\Provider\Domain\Model\QueueMember\QueueMember');

        $queueMemberId = $this->agi->getExtension();

        /** @var \Ivoz\Ast\Domain\Model\QueueMember\QueueMemberInterface $queueMember */
        $queueMember = $queueMemberRepository->find($queueMemberId);

        Assertion::notNull(
            $queueMember,
            sprintf("Queue member with id %d does not exists.", $queueMemberId)
        );

        /** @var \Ivoz\Provider\Domain\Model\User\UserInterface $user */
        $user = $queueMember->getUser();
        Assertion::notNull(
            $user,
            sprintf("No user found for queue member %d", $queueMemberId)
        );

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $user->getEndpoint();
        Assertion::notNull(
            $endpoint,
            sprintf("User %d has no endpoint associated", $user->getId())
        );

        $this->agi->setVariable("DIAL_OPTS", "ic");
        $this->agi->setVariable("DIAL_DST", "PJSIP/" . $endpoint->getSorceryId());
    }

    /**
     * @brief After Queue process
     */
    public function queuestatusAction()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\Queue\QueueRepository $queueRepository */
        $queueRepository = $em->getRepository('\Ivoz\Provider\Domain\Model\Queue\Queue');

        $queueId = $this->agi->getVariable("QUEUE_ID");

        /** @var \Ivoz\Ast\Domain\Model\Queue\QueueInterface $queue */
        $queue = $queueRepository->find($queueId);

        // Process Queue Timeout
        $queueAction = new QueueAction($this);
        $queueAction
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

        // Get friend from the endpoint.
        $friend = $this->getFriendFromEndpoint($endpointName);

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

        // Set Friend as the caller
        $this->agi->setChannelCaller($friend);
        $this->agi->setChannelOrigin($friend);

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
                ->setExtension($dstExtension)
                ->process();

        } else if (($outfriend = $company->getFriend($exten))) {
            $this->agi->verbose("Number %s is handled by friendly trunk.", $exten);

            // Handle call through friendly trunk
            $friendAction = new FriendCallAction($this);
            $friendAction
                ->setFriend($outfriend)
                ->setDestination($exten)
                ->call();

        // This number don't belong to IvozProvider
        } else {
            $this->agi->verbose("Number %s is handled as external number.", $exten);

            // Otherwise, handle this call as external
            $externalCallAction = new ExternalFriendCallAction($this);
            $externalCallAction
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

        // Get retail from the endpoint.
        $retail = $this->getRetailFromEndpoint($endpointName);

        // Set Company/Brand/Generic Music class
        $company = $retail->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $this->agi->setChannelCaller($retail);

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from Retail account \e[0;36m%s [retail%d]\e[0;93m to number %s",
                        $retail->getName(), $retail->getId(), $exten);

        // Otherwise, handle this call as external
        $externalCallAction = new ExternalRetailCallAction($this);
        $externalCallAction
            ->setDestination($exten)
            ->process();
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
            $ivrType = $this->agi->getVariable("IVRTYPE");

            /** @var \Doctrine\ORM\EntityManager $em */
            $em = \Zend_Registry::get("em");

            if ($ivrType == 'COMMON') {
                /** @var \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonRepository $ivrRespository */
                $ivrRespository = $em->getRepository('\Ivoz\Provider\Domain\Model\IvrCommon\IvrCommon');
            } else {
                /** @var \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomRepository $ivrRespository */
                $ivrRespository = $em->getRepository('\Ivoz\Provider\Domain\Model\IvrCustom\IvrCustom');
            }

            // Get IVR data
            $ivr = $ivrRespository->find($ivrId);

            // Process NoAnswer handler
            $ivrAction = new IVRAction($this);
            $ivrAction
                ->setIvr($ivr)
                ->processTimeout();
        }
    }

    /**
     * @brief Call a user from a Huntgroup
     */
    public  function hgcalluserAction()
    {

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupRepository $huntgroupRepository */
        $huntgroupRepository = $em->getRepository('\Ivoz\Provider\Domain\Model\Huntgroup\Huntgroup');

        // Get conference Id from extension
        $huntgroupId = $this->agi->getVariable("HG_ID");

        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntgroup */
        $huntgroup = $huntgroupRepository->find($huntgroupId);

        // Continue processing
        $hungroupAction = new HuntGroupAction($this);
        $hungroupAction
            ->setHuntGroup($huntgroup)
            ->call();
    }

    /**
     * @brief Process Huntgroup after call status
     */
    public function hgstatusAction ()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupRepository $huntgroupRepository */
        $huntgroupRepository = $em->getRepository(HuntGroup::class);

        // Get conference Id from extension
        $huntgroupId = $this->agi->getVariable("HG_ID");

        /** @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntgroup */
        $huntgroup = $huntgroupRepository->find($huntgroupId);

        // Continue processing
        $hungroupAction = new HuntGroupAction($this);
        $hungroupAction
            ->setHuntGroup($huntgroup)
            ->processHuntgroupStatus();
    }

    /**
     * @brief Add SIP Headers for proxies
     */
    public function addheadersAction()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyRepository $companyRepository */
        $companyRepository = $em->getRepository('\Ivoz\Provider\Domain\Model\Company\Company');

        // Get company from channel variables
        $companyId = $this->agi->getVariable("COMPANYID");

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company */
        $company = $companyRepository->find($companyId);

        // Add headers for Friendly Kamailio  Proxy;-))
        $this->agi->setSIPHeader("X-Call-Id",            $this->agi->getVariable("CALL_ID"));
        $this->agi->setSIPHeader("X-Info-BrandId",       $company->getBrand()->getId());
        $this->agi->setSIPHeader("X-Info-CompanyId",     $company->getId());
        $this->agi->setSIPHeader("X-Info-CompanyName",   $company->getName());
        $this->agi->setSIPHeader("X-Info-MediaRelaySet", $company->getMediaRelaySets()->getId());

        // Get Calle data, take if from called endpoint
        $endpoint = $this->getEndpointFromName($this->agi->getEndpoint());
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
        if ($this->agi->getVariable("CHANNEL(namedpickupgroup)")) {
            $this->agi->setVariable("CHANNEL(namedcallgroup)", $this->agi->getVariable("CHANNEL(namedpickupgroup)"));
        }
    }

    private function getEndpointNameFromContact($endpointNum, $endpointDomain)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Provider\Domain\Model\Domain\DomainRepository $domainRepository */
        $domainRepository = $em->getRepository(Domain::class);
        /** @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain */
        $domain = $domainRepository->findOneBy([
            'domain' => $endpointDomain
        ]);

        Assertion::notNull(
            $domain,
            sprintf('No Domain found for "%s".', $endpointDomain)
        );

        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalRepository $terminalRepository */
        $terminalRepository = $em->getRepository(Terminal::class);
        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal */
        $terminal = $terminalRepository->findOneBy([
            'name' => $endpointNum,
            'domain' => $domain->getId()
        ]);

        Assertion::notNull(
            $terminal,
            sprintf('No Terminal found for "%s@%s"', $endpointNum, $endpointDomain)
        );

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $terminal->getAstPsEndpoint();
        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointNum)
        );

        // Get the endpoint name matching the referer contact
        return $endpoint->getSorceryId();
    }


    private function getEndpointFromName($endpointName)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository $endpointRepository */
        $endpointRepository = $em->getRepository('Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint');

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $endpointRepository->findOneBy([
            "sorceryId" => $endpointName
        ]);

        return $endpoint;
    }

    private function getUserFromEndpoint($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal */
        $terminal = $endpoint->getTerminal();

        Assertion::notNull(
            $terminal,
            sprintf('Endpoint "%s" has no terminal associated.', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\User\UserInterface $user */
        $user = $terminal->getUser();

        Assertion::notNull(
            $user,
            sprintf('Terminal "%s" has no user associated.', $terminal->getId())
        );

        /** @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension */
        $extension = $user->getExtension();

        Assertion::notNull(
            $extension,
            sprintf('User "%s" has no extension associated.', $user->getId())
        );

        return $user;
    }

    private function getFriendFromEndpoint($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend */
        $friend = $endpoint->getFriend();

        Assertion::notNull(
            $friend,
            sprintf('Endpoint "%s" has no friend associated.', $endpointName)
        );

        return $friend;
    }

    private function getRetailFromEndpoint($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retail */
        $retail = $endpoint->getRetailAccount();

        Assertion::notNull(
            $retail,
            sprintf('Endpoint "%s" has no retail associated.', $endpointName)
        );

        return retail;
    }

}
