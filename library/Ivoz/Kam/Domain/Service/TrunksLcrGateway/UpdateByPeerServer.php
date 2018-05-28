<?php
namespace Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;

/**
 * Class UpdateByPeerServer
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
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

        $lcrGatewayDto = is_null($lcrGateway)
            ? TrunksLcrGateway::createDto()
            : $lcrGateway->toDto();

        // Update/Create LcrGateway for this PeerServer
        $lcrGatewayDto
            ->setGwName($entity->getName())
            ->setIp($entity->getIp())
            ->setHostname($entity->getHostname())
            ->setPort($entity->getPort())
            ->setUriScheme($entity->getUriScheme())
            ->setTransport($entity->getTransport())
            ->setPeerServerId($entity->getId());

        $lcrGateway = $this->entityPersister->persistDto(
            $lcrGatewayDto,
            $lcrGateway,
            true
        );

        $entity->setLcrGateway($lcrGateway);
    }
}