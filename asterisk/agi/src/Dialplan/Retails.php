<?php

namespace Dialplan;

use Agi\Action\ExternalNumberAction;
use Agi\Action\ServiceAction;
use Agi\Agents\RetailAgent;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use RouteHandlerAbstract;

class Retails extends RouteHandlerAbstract
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
     * @var ExternalNumberAction
     */
    protected $externalNumberAction;

    /**
     * Retails constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EndpointResolver $endpointResolver
     * @param ExternalNumberAction $externalNumberAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EndpointResolver $endpointResolver,
        ExternalNumberAction $externalNumberAction
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->endpointResolver = $endpointResolver;
        $this->externalNumberAction = $externalNumberAction;
    }

    /**
     * Outgoing calls from retail accounts
     *
     * @throws \InvalidArgumentException
     */
    public function process()
    {
        // Get identified Endpoint name
        $endpointName = $this->agi->getEndpoint();

        // Get retailAccount from the endpoint.
        $retailAccount = $this->endpointResolver->getRetailFromEndpoint($endpointName);
        $this->agi->setVariable("__RETAILACCOUNTID", $retailAccount->getId());

        // Set Company/Brand/Generic Music class
        $company = $retailAccount->getCompany();
        $brand = $company->getBrand();
        $this->agi->setVariable("__COMPANYID", $company->getId());
        $this->agi->setVariable("CHANNEL(language)", $company->getLanguageCode());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $caller = new RetailAgent($this->agi, $retailAccount);
        $this->channelInfo->setChannelCaller($caller);

        // Only forwarded calls or T.38 calls are allowed from retail accounts
        $isCallForward = $this->agi->getRedirecting('count') != 0;
        $isFax = $retailAccount->getT38Passthrough() === RetailAccountInterface::T38PASSTHROUGH_YES;

        if (!$isFax && !$isCallForward) {
            $this->agi->error(
                "Non-T.38 call without Diversion header from <cyan>%s</cyan> to number %s, drop call",
                $retailAccount,
                $exten
            );
            $this->agi->hangup();
            return;
        }

        // If this call is not being forwarded, retail is also the origin
        if (!$isCallForward) {
            $this->channelInfo->setChannelOrigin($caller);
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing outgoing call from \e[0;36m%s\e[0;93m to number %s", $retailAccount, $exten);

        // All retail account calls are handled as external
        $this->externalNumberAction
            ->setDestination($exten)
            ->process();
    }
}
