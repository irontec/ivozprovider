<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;

class UpdateByRetailAccount implements RetailAccountLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private PsEndpointRepository $psEndpointRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @param RetailAccountInterface $retailAccount
     *
     * @return void
     */
    public function execute(RetailAccountInterface $retailAccount)
    {
        $endpoint = $this->psEndpointRepository->findOneByRetailAccountId(
            (int) $retailAccount->getId()
        );

        // If not found create a new one
        if (is_null($endpoint)) {
            $endpointDto = PsEndpoint::createDto();
            $endpointDto
                ->setContext('retail')
                ->setSendDiversion('yes')
                ->setSendPai('yes');
        } else {
            /** @var PsEndpointDto $endpointDto */
            $endpointDto  = $this->entityTools->entityToDto($endpoint);
        }

        // Use company domain if retail account from-domain not set
        $fromDomain = $retailAccount->getFromDomain()
            ? $retailAccount->getFromDomain()
            : $retailAccount->getDomain()->getDomain();

        // Update/Insert endpoint data
        $endpointDto
            ->setRetailAccountId($retailAccount->getId())
            ->setSorceryId($retailAccount->getSorcery())
            ->setFromDomain($fromDomain)
            ->setAors($retailAccount->getSorcery())
            ->setDisallow("all")
            ->setAllow("alaw,g729,ulaw")
            ->setDirectmediaMethod('invite')
            ->setTrustIdInbound('yes')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setT38Udptl($retailAccount->getT38Passthrough())
            ->setDirectMedia('no');

        $this->entityTools->persistDto($endpointDto, $endpoint);
    }
}
