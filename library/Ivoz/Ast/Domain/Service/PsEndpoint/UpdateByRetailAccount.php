<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;

class UpdateByRetailAccount implements RetailAccountLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var PsEndpointRepository
     */
    protected $psEndpointRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        PsEndpointRepository $psEndpointRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->psEndpointRepository = $psEndpointRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param RetailAccountInterface $entity
     */
    public function execute(RetailAccountInterface $entity, $isNew)
    {
        /**
         * @var PsEndpointInterface $endpoint
         */
        $endpoint = $this->psEndpointRepository->findOneBy([
            'retailAccount' => $entity->getId()
        ]);

        // If not found create a new one
        if (is_null($endpoint)) {

            $endpointDTO = PsEndpoint::createDto();
            $endpointDTO
                ->setContext('retail')
                ->setSendDiversion('yes')
                ->setSendPai('yes');
        } else {
            $endpointDTO  = $endpoint->toDto();
        }

        // Use company domain if retail from-domain not set
        $fromDomain = $entity->getFromDomain()
            ? $entity->getFromDomain()
            : $entity->getDomain()->getDomain();

        // Update/Insert endpoint data
        $endpointDTO
            ->setRetailAccountId($entity->getId())
            ->setSorceryId($entity->getSorcery())
            ->setFromDomain($fromDomain)
            ->setAors($entity->getSorcery())
            ->setDisallow($entity->getDisallow())
            ->setAllow($entity->getAllow())
            ->setDirectmediaMethod($entity->getDirectmediaMethod())
            ->setTrustIdInbound('yes')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setDirectMediaMethod('invite');

        $this->entityPersister->persistDto($endpointDTO, $endpoint);
    }
}