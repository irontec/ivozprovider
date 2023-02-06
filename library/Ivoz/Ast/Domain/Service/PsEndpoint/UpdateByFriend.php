<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Friend\FriendLifecycleEventHandlerInterface;

class UpdateByFriend implements FriendLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityPersisterInterface $entityPersister,
        private PsEndpointRepository $psEndpointRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(FriendInterface $friend)
    {
        // Replicate Terminal into ast_ps_endpoint
        $endpoint = $this->psEndpointRepository->findOneByFriendId(
            (int) $friend->getId()
        );

        if (is_null($endpoint)) {
            $endPointDto = new PsEndpointDto();
            $endPointDto
                ->setContext("friends")
                ->setSendDiversion("yes")
                ->setSendPai("yes");
        } else {
            $endPointDto = $endpoint->toDto();
        }

        // Use company domain if friend from-domain not set
        $fromDomain = $friend->getFromDomain()
            ? $friend->getFromDomain()
            : $friend->getDomain()->getDomain();

        // Disable directMedia for intervpbx friends
        if ($friend->isInterPbxConnectivity()) {
            $endPointDto->setDirectMedia('no');
        }

        // Update/Insert endpoint data
        $endPointDto
            ->setFriendId($friend->getId())
            ->setSorceryId($friend->getSorcery())
            ->setFromDomain($fromDomain)
            ->setAors($friend->getSorcery())
            ->setDisallow($friend->getDisallow())
            ->setAllow($friend->getAllow())
            ->setTrustIdInbound('yes')
            ->setOutboundProxy('sip:users.ivozprovider.local^3Blr')
            ->setT38Udptl($friend->getT38Passthrough())
            ->setDirectMedia('no')
            ->setDirectMediaMethod(PsEndpointInterface::DIRECTMEDIAMETHOD_INVITE);

        $this->entityPersister->persistDto($endPointDto, $endpoint, true);
    }
}
