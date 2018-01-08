<?php

namespace Dialplan;

use Agi\Action\ExternalRetailCallAction;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use RouteHandlerAbstract;

class Retailers extends RouteHandlerAbstract
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
     * @var ExternalRetailCallAction
     */
    protected $externalRetailCallAction;

    /**
     * Retails constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EndpointResolver $endpointResolver
     * @param ExternalRetailCallAction $externalRetailCallAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EndpointResolver $endpointResolver,
        ExternalRetailCallAction $externalRetailCallAction
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->endpointResolver = $endpointResolver;
        $this->externalRetailCallAction = $externalRetailCallAction;
    }

    /**
     * Outgoing calls from retail caccounts
     *
     * @throws \Assert\AssertionFailedException
     */
    public function process()
    {
        // Get identified Enpoint name
        $endpointName = $this->agi->getEndpoint();

        // Get retail from the endpoint.
        $retail = $this->endpointResolver->getRetailFromEndpoint($endpointName);

        // Set Company/Brand/Generic Music class
        $company = $retail->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $this->channelInfo->setChannelCaller($retail);

        // Some feedback for asterisk cli
        $this->agi->notice(
            "Processing outgoing call from Retail account \e[0;36m%s [retail%d]\e[0;93m to number %s",
            $retail->getName(),
            $retail->getId(),
            $exten
        );

        // All retail calls are handled as external
        $this->externalRetailCallAction
            ->setDestination($exten)
            ->process();
    }

}