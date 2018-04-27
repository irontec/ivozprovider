<?php
namespace Ivoz\Provider\Domain\Service\LcrGateway;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\LcrGateway\LcrGateway;

/**
 * Class UpdateByPeerServer
 * @package Ivoz\Provider\Domain\Service\LcrGateway
 */
class UpdateByPeerServer implements PeerServerLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(PeerServerInterface $entity, $isNew)
    {
        $lcrGateway = $entity->getLcrGateway();

        $lcrGatewayDTO = is_null($lcrGateway)
            ? LcrGateway::createDto()
            : $lcrGateway->toDto();

        // Update/Create LcrGateway for this PeerServer
        $lcrGatewayDTO
            ->setGwName($entity->getName())
            ->setIp($entity->getIp())
            ->setHostname($entity->getHostname())
            ->setPort($entity->getPort())
            ->setParams($entity->getParams())
            ->setUriScheme($entity->getUriScheme())
            ->setTransport($entity->getTransport())
            ->setTag((string) $entity->getId())
            ->setFlags($entity->getFlags())
            ->setPeerServerId($entity->getId());

        $lcrGateway = $this->entityPersister->persistDto(
            $lcrGatewayDTO,
            $lcrGateway,
            true
        );

        $entity->setLcrGateway($lcrGateway);
    }
}