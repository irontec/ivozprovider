<?php

namespace Dialplan;

use Agi\Action\ExternalNumberAction;
use Agi\Action\ServiceAction;
use Agi\Agents\ResidentialAgent;
use Agi\ChannelInfo;
use Agi\Webhook\WebhookEventPublisher;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
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
     * @var BrandServiceRepository
     */
    protected $brandServiceRepository;

    /**
     * @var ExternalNumberAction
     */
    protected $externalNumberAction;

    /**
     * @var ServiceAction
     */
    protected $serviceAction;

    /**
     * @var WebhookEventPublisher
     */
    protected $webhookEventPublisher;

    /**
     * Residentials constructor.
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        BrandServiceRepository $brandServiceRepository,
        EndpointResolver $endpointResolver,
        ExternalNumberAction $externalNumberAction,
        ServiceAction $serviceAction,
        WebhookEventPublisher $webhookEventPublisher
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->brandServiceRepository = $brandServiceRepository;
        $this->endpointResolver = $endpointResolver;
        $this->externalNumberAction = $externalNumberAction;
        $this->serviceAction = $serviceAction;
        $this->webhookEventPublisher = $webhookEventPublisher;
    }

    /**
     * Outgoing calls from residential devices
     *
     * @throws \InvalidArgumentException
     */
    public function process()
    {
        // Get identified Enpoint name
        $endpointName = $this->agi->getEndpoint();

        // Get residential from the endpoint.
        $residential = $this->endpointResolver->getResidentialFromEndpoint($endpointName);
        $this->agi->setVariable("__RESIDENTIALDEVICEID", $residential->getId());

        // Set Company/Brand/Generic Music class
        $company = $residential->getCompany();
        $brand = $company->getBrand();
        $this->agi->setVariable("__COMPANYID", $company->getId());
        $this->agi->setVariable("__COMPANYTYPE", $company->getType());
        $this->agi->setVariable("__BRANDID", $brand->getId());
        $this->agi->setVariable("CHANNEL(language)", $company->getLanguageCode());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $caller = new ResidentialAgent($this->agi, $residential);
        $this->channelInfo->setChannelCaller($caller);

        // If this call is not being forwarded, residential is also the origin
        if ($this->agi->getRedirecting('count') == 0) {
            $this->channelInfo->setChannelOrigin($caller);
        }

        // Publish call start event to webhooks
        $this->webhookEventPublisher->publish('start');

        // Check if this extension starts with '*' code
        if (strpos($exten, '*') === 0) {
            if (($service = $brand->getService($exten))) {
                $this->agi->verbose("Number %s belongs to a %s.", $exten, $service);

                // Handle service code
                $this->serviceAction
                    ->setService($service)
                    ->process();
            } else {
                // Decline this call if not matching service is found
                $this->agi->verbose("Invalid Service code %s for brand %s", $exten, $brand);
                $this->agi->hangup();
            }
        } else {
            // Some feedback for asterisk cli
            $this->agi->notice("Processing outgoing call from \e[0;36m%s\e[0;93m to number %s", $residential, $exten);

            // All residential calls are handled as external
            $this->externalNumberAction
                ->setDestination($exten)
                ->process();
        }
    }
}
