<?php

namespace Dialplan;

use Agi\Action\ResidentialStatusAction;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use RouteHandlerAbstract;

class ResidentialStatus extends RouteHandlerAbstract
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EndpointResolver
     */
    protected $endpointResolver;

    /**
     * @var ResidentialStatusAction
     */
    protected $residentialStatusAction;

    /**
     * ResidentialStatus constructor.
     *
     * @param Wrapper $agi
     * @param EndpointResolver $endpointResolver
     * @param ResidentialStatusAction $residentialStatusAction
     */
    public function __construct(
        Wrapper $agi,
        EndpointResolver $endpointResolver,
        ResidentialStatusAction $residentialStatusAction
    ) {
        $this->agi = $agi;
        $this->endpointResolver = $endpointResolver;
        $this->residentialStatusAction = $residentialStatusAction;
    }


    /**
     * Outgoing calls from terminals to Extensions, Services or World
     *
     * @throws \Assert\AssertionFailedException
     */
    public function process()
    {
        // Get the called endpoint to check postcall actions
        $endpointName = $this->agi->getVariable("DIAL_ENDPOINT");

        // Get device from the endpoint.
        $residentialDevice = $this->endpointResolver->getResidentialFromEndpoint($endpointName);

        // ProcessDialStatus
        $this->residentialStatusAction
            ->setResidentialDevice($residentialDevice)
            ->process();
    }
}
