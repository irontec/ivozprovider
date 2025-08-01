<?php

namespace Dialplan;

use Agi\Action\ExtensionAction;
use Agi\Action\ExternalFriendCallAction;
use Agi\Action\ExternalNumberAction;
use Agi\Action\FriendCallAction;
use Agi\Action\ServiceAction;
use Agi\Agents\FriendAgent;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use RouteHandlerAbstract;

class Friends extends RouteHandlerAbstract
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
     * @var EndpointResolver
     */
    protected $endpointResolver;

    /**
     * @var ServiceAction
     */
    protected $serviceAction;

    /**
     * @var ExtensionAction
     */
    protected $extensionAction;

    /**
     * @var FriendCallAction
     */
    protected $friendCallAction;

    /**
     * @var ExternalNumberAction
     */
    protected $externalNumberAction;

    /**
     * Friends constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EndpointResolver $endpointResolver
     * @param ExtensionAction $extensionAction
     * @param FriendCallAction $friendCallAction
     * @param ExternalNumberAction $externalNumberAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EndpointResolver $endpointResolver,
        ServiceAction $serviceAction,
        ExtensionAction $extensionAction,
        FriendCallAction $friendCallAction,
        ExternalNumberAction $externalNumberAction
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->endpointResolver = $endpointResolver;
        $this->serviceAction = $serviceAction;
        $this->extensionAction = $extensionAction;
        $this->friendCallAction = $friendCallAction;
        $this->externalNumberAction = $externalNumberAction;
    }


    /**
     * @throws \InvalidArgumentException
     */
    public function process()
    {
        // Get Refer information
        $transferred = $this->agi->getVariable("SIPTRANSFER");
        if (!empty($transferred)) {
            // Get transferer endpoint name
            $endpointName = $this->agi->getVariable("DIALEDPEERNUMBER");
        } else {
            /** Normal call from User's terminal  */
            // Get endpoint name from channel
            $endpointName = $this->agi->getEndpoint();
        }

        // Get friend from the endpoint.
        $friend = $this->endpointResolver->getFriendFromEndpoint($endpointName);
        $this->agi->setVariable("__FRIENDID", $friend->getId());

        // Set Company/Brand/Generic Music class
        $company = $friend->getCompany();
        $brand = $company->getBrand();
        $this->agi->setVariable("__COMPANYID", $company->getId());
        $this->agi->setVariable("__COMPANYTYPE", $company->getType());
        $this->agi->setVariable("__BRANDID", $brand->getId());

        // Check User's permission to does this call
        $exten = $this->agi->getExtension();

        // Mark this call as generated from user
        $this->agi->setVariable("__CALL_TYPE", "internal");

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set user language and music
        $this->agi->setVariable("CHANNEL(language)", $friend->getLanguageCode());
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());

        // Set Friend as the caller
        $caller = new FriendAgent($this->agi, $friend);
        $this->channelInfo->setChannelCaller($caller);

        // If this call is not being forwarded, residential is also the origin
        if ($this->agi->getRedirecting('count') == 0) {
            $this->channelInfo->setChannelOrigin($caller);
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from \e[0;36m%s\e[0;93m to number %s", $friend, $exten);

        // Check if this extension starts with '*' code
        if (strpos($exten, '*') === 0) {
            if (($service = $company->getService($exten))) {
                // Handle service code
                $this->serviceAction
                    ->setService($service)
                    ->process();
            } else {
                // Decline this call if not matching service is found
                $this->agi->error("Invalid Service code %s for company  %s", $exten, $company);
                $this->agi->hangup();
            }

            // Check if this is an extension call
        } elseif (($dstExtension = $company->getExtension($exten))) {
            $this->agi->verbose(
                "Number %s belongs to a Company Extension [extension%d].",
                $exten,
                $dstExtension->getId()
            );

            // Handle extension
            $this->extensionAction
                ->setExtension($dstExtension)
                ->process();
        } elseif (($outfriend = $company->getFriend($exten))) {
            $this->agi->verbose("Number %s is handled by friendly trunk.", $exten);

            // Handle call through friendly trunk
            $this->friendCallAction
                ->setFriend($outfriend)
                ->setDestination($exten)
                ->process();
        } else {
            // This number don't belong to IvozProvider
            $this->agi->verbose("Number %s is handled as external number.", $exten);

            if (!$caller->isAllowedToCall($exten)) {
                $this->agi->error("%s is not allowed to call %s", $caller, $exten);
                // Play error notification over progress
                if ($company->hasFeature(Feature::PROGRESS)) {
                    $this->agi->progress("ivozprovider/notAllowed");
                }
                $this->agi->decline();
                return;
            }

            // Otherwise, handle this call as external
            $this->externalNumberAction
                ->setDestination($exten)
                ->process();
        }
    }
}
