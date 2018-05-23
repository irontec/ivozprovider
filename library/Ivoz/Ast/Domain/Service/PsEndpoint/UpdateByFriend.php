<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Friend\FriendLifecycleEventHandlerInterface;

class UpdateByFriend implements FriendLifecycleEventHandlerInterface
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
     * @param Friend $entity
     */
    public function execute(FriendInterface $entity, $isNew)
    {
        // Replicate Terminal into ast_ps_endpoint
        /**
         * @var PsEndpoint $endpoint
         */
        $endpoint = $this->psEndpointRepository->findOneBy([
            "friend" => $entity->getId()
        ]);

        if (is_null($endpoint)) {
            $endPointDto = new PsEndpointDto();
            $endPointDto
                ->setContext("friends")
                ->setSendDiversion("yes")
                ->setSendPai("yes");
        } else {
            $endPointDto = $endpoint->toDto();
        }

        // Use company domain if retail from-domain not set
        $fromDomain = $entity->getFromDomain()
            ? $entity->getFromDomain()
            : $entity->getDomain()->getDomain();

        // Update/Insert endpoint data
        $domainUsers = $entity->getCompany()->getDomainUsers();
        $endPointDto
            ->setFriendId($entity->getId())
            ->setSorceryId($entity->getSorcery())
            ->setFromDomain($fromDomain)
            ->setAors($entity->getSorcery())
            ->setDisallow($entity->getDisallow())
            ->setAllow($entity->getAllow())
            ->setDirectmediaMethod($entity->getDirectmediaMethod())
            ->setTrustIdInbound('yes')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setDirectMediaMethod('invite');

        $this->entityPersister->persistDto($endPointDto, $endpoint, true);
    }
}