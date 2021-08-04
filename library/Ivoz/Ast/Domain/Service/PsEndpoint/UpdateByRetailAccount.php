<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;

class UpdateByRetailAccount implements RetailAccountLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var PsEndpointRepository
     */
    protected $psEndpointRepository;

    public function __construct(
        EntityTools $entityTools,
        PsEndpointRepository $psEndpointRepository
    ) {
        $this->entityTools = $entityTools;
        $this->psEndpointRepository = $psEndpointRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @param RetailAccountInterface $entity
     *
     * @return void
     */
    public function execute(RetailAccountInterface $entity)
    {
        $endpoint = $this->psEndpointRepository->findOneByRetailAccountId(
            $entity->getId()
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
        $fromDomain = $entity->getFromDomain()
            ? $entity->getFromDomain()
            : $entity->getDomain()->getDomain();

        // Update/Insert endpoint data
        $endpointDto
            ->setRetailAccountId($entity->getId())
            ->setSorceryId($entity->getSorcery())
            ->setFromDomain($fromDomain)
            ->setAors($entity->getSorcery())
            ->setDisallow("all")
            ->setAllow("alaw,g729,ulaw")
            ->setDirectmediaMethod('invite')
            ->setTrustIdInbound('yes')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setT38Udptl($entity->getT38Passthrough())
            ->setDirectMedia('no');

        $this->entityTools->persistDto($endpointDto, $endpoint);
    }
}
