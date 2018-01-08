<?php

namespace Dialplan;

use Agi\Action\ExtensionAction;
use Agi\Action\ExternalFriendCallAction;
use Agi\Action\FriendCallAction;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Helpers\EndpointResolver;
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
     * @var ExtensionAction
     */
    protected $extensionAction;

    /**
     * @var FriendCallAction
     */
    protected $friendCallAction;

    /**
     * @var ExternalFriendCallAction
     */
    protected $externalFriendCallAction;

    /**
     * Friends constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EndpointResolver $endpointResolver
     * @param ExtensionAction $extensionAction
     * @param FriendCallAction $friendCallAction
     * @param ExternalFriendCallAction $externalFriendCallAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EndpointResolver $endpointResolver,
        ExtensionAction $extensionAction,
        FriendCallAction $friendCallAction,
        ExternalFriendCallAction $externalFriendCallAction
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->endpointResolver = $endpointResolver;
        $this->extensionAction = $extensionAction;
        $this->friendCallAction = $friendCallAction;
        $this->externalFriendCallAction = $externalFriendCallAction;
    }


    /**
     * @throws \Assert\AssertionFailedException
     */
    public function process()
    {
        // Get identified Enpoint name
        $endpointName = $this->agi->getEndpoint();

        // Get friend from the endpoint.
        $friend = $this->endpointResolver->getFriendFromEndpoint($endpointName);

        // Set Company/Brand/Generic Music class
        $company = $friend->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Check User's permission to does this call
        $exten = $this->agi->getExtension();

        // Mark this call as generated from user
        $this->agi->setVariable("__CALL_TYPE", "internal");

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set user language and music
        $this->agi->setVariable("CHANNEL(language)",   $friend->getLanguageCode());
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());

        // Set Friend as the caller
        $this->channelInfo->setChannelCaller($friend);
        $this->channelInfo->setChannelOrigin($friend);

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from \e[0;36m%s\e[0;93m to number %s", $friend, $exten);

        // Check if this is an extension call
        if (($dstExtension = $company->getExtension($exten))) {

            $this->agi->verbose("Number %s belongs to a Company Extension [extension%d].",
                $exten, $dstExtension->getId());

            // Handle extension
            $this->extensionAction
                ->setExtension($dstExtension)
                ->process();

        } else if (($outfriend = $company->getFriend($exten))) {
            $this->agi->verbose("Number %s is handled by friendly trunk.", $exten);

            // Handle call through friendly trunk
            $this->friendCallAction
                ->setFriend($outfriend)
                ->setDestination($exten)
                ->process();

        } else {
            // This number don't belong to IvozProvider
            $this->agi->verbose("Number %s is handled as external number.", $exten);

            // Otherwise, handle this call as external
            $this->externalFriendCallAction
                ->setFriend($friend)
                ->setDestination($exten)
                ->process();

        }
    }


}