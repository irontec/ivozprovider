<?php

namespace Dialplan;

use Agi\Action\ExternalResidentialCallAction;
use Agi\Action\ServiceAction;
use Agi\ChannelInfo;
use Agi\Wrapper;
use Helpers\EndpointResolver;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\Service\Service;
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
     * @var ExternalResidentialCallAction
     */
    protected $externalResidentialCallAction;

    /**
     * @var ServiceAction
     */
    protected $serviceAction;

    /**
     * Residentials constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param BrandServiceRepository $brandServiceRepository
     * @param EndpointResolver $endpointResolver
     * @param ExternalResidentialCallAction $externalResidentialCallAction
     * @param ServiceAction $serviceAction
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        BrandServiceRepository $brandServiceRepository,
        EndpointResolver $endpointResolver,
        ExternalResidentialCallAction $externalResidentialCallAction,
        ServiceAction $serviceAction
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->brandServiceRepository = $brandServiceRepository;
        $this->endpointResolver = $endpointResolver;
        $this->externalResidentialCallAction = $externalResidentialCallAction;
        $this->serviceAction = $serviceAction;
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
        $brand = $company->getBrand();
        $this->agi->setVariable("__COMPANYID", $company->getId());
        $this->agi->setVariable("CHANNEL(language)", $company->getLanguageCode());

        // Get call destination
        $exten = $this->agi->getExtension();

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("_CALL_ID", $this->agi->getCallId());

        // Set User as the caller
        $this->channelInfo->setChannelCaller($residential);

        // Check if this extension starts with '*' code
        if (strpos($exten, '*') === 0) {
            $service = $this->brandServiceRepository
                ->findByIden(
                    $brand,
                    Service::VOICEMAIL
                );

            /** @var BrandService $service */
            if ($service) {
                if ($service->getCode() == substr($exten, 1)) {
                    $this->agi->verbose("Number %s belongs to a %s.", $exten, $service);
                    // Handle service code
                    $this->serviceAction
                        ->setService($service)
                        ->process();
                }
            } else {
                // Decline this call if not matching service is found
                $this->agi->verbose("Invalid Service code %s for brand %s", $exten, $brand);
                $this->agi->hangup();
            }
        } else {
            // Some feedback for asterisk cli
            $this->agi->notice("Processing outgoing call from \e[0;36m%s\e[0;93m to number %s", $residential, $exten);

            // All residential calls are handled as external
            $this->externalResidentialCallAction
                ->setDestination($exten)
                ->process();
        }

    }

}