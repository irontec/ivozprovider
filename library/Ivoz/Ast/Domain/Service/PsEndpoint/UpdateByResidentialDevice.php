<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Service\ResidentialDevice\ResidentialDeviceLifecycleEventHandlerInterface;

class UpdateByResidentialDevice implements ResidentialDeviceLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private PsEndpointRepository $psEndpointRepository
    ) {
    }


    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param ResidentialDeviceInterface $residentialDevice
     *
     * @return void
     */
    public function execute(ResidentialDeviceInterface $residentialDevice)
    {
        $endpoint = $this->psEndpointRepository->findOneByResidentialDeviceId(
            (int) $residentialDevice->getId()
        );

        // If not found create a new one
        if (is_null($endpoint)) {
            $endpointDto = PsEndpoint::createDto();
            $endpointDto
                ->setContext('residential')
                ->setSendDiversion('yes')
                ->setSendPai('yes');
        } else {
            // @todo use entityTools here
            $endpointDto  = $endpoint->toDto();
        }

        // Use company domain if residential device from-domain not set
        $fromDomain = $residentialDevice->getFromDomain()
            ? $residentialDevice->getFromDomain()
            : $residentialDevice->getDomain()->getDomain();

        // Get Residential Voicemail
        $voicemail = $residentialDevice->getVoicemail();

        // Update/Insert endpoint data
        $endpointDto
            ->setResidentialDeviceId($residentialDevice->getId())
            ->setSorceryId($residentialDevice->getSorcery())
            ->setFromDomain($fromDomain)
            ->setAors($residentialDevice->getSorcery())
            ->setDisallow($residentialDevice->getDisallow())
            ->setAllow($residentialDevice->getAllow())
            ->setDirectmediaMethod($residentialDevice->getDirectmediaMethod())
            ->setTrustIdInbound('yes')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setT38Udptl($residentialDevice->getT38Passthrough())
            ->setMailboxes($voicemail?->getVoicemailName())
            ->setDirectMediaMethod('invite');

        // Disable direct media for T.38 capable devices
        if ($residentialDevice->getT38Passthrough() === ResidentialDeviceInterface::T38PASSTHROUGH_YES) {
            $endpointDto->setDirectMedia('no');
        } else {
            $endpointDto->setDirectMedia('yes');
        }

        $this->entityTools->persistDto($endpointDto, $endpoint);
    }
}
