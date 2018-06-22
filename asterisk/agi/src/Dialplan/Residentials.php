<?php

namespace Dialplan;

use Agi\Action\ExternalResidentialCallAction;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use RouteHandlerAbstract;

class Residentials extends RouteHandlerAbstract
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
     * @var ExternalResidentialCallAction
     */
    protected $externalResidentialCallAction;

    /**
     * Residentials constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EndpointResolver $endpointResolver
     * @param ExternalResidentialCallAction $externalResidentialCallAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EndpointResolver $endpointResolver,
        ExternalResidentialCallAction $externalResidentialCallAction
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->endpointResolver = $endpointResolver;
        $this->externalResidentialCallAction = $externalResidentialCallAction;
    }

    /**
     * Outgoing calls from residential devices
     *
     * @throws \Assert\AssertionFailedException
     */
    public function process()
    {
        // Get identified Enpoint name
        $endpointName = $this->agi->getEndpoint();

        // Get residential from the endpoint.
        $residential = $this->endpointResolver->getResidentialFromEndpoint($endpointName);

        // Set Company/Brand/Generic Music class
        $company = $residential->getCompany();
        $this->agi->setVariable("__COMPANYID", $company->getId());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $this->channelInfo->setChannelCaller($residential);

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from \e[0;36m%s\e[0;93m to number %s", $residential, $exten);

        // All residential calls are handled as external
        $this->externalResidentialCallAction
            ->setDestination($exten)
            ->process();
    }

}