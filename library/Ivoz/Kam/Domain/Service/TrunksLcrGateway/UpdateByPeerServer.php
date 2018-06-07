<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;

/**
 * Class UpdateByPeerServer
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class UpdateByPeerServer implements PeerServerLifecycleEventHandlerInterface
{
    CONST POST_PERSIST_PRIORITY = 10;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
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

        $lcrGateway = $this->entityTools->persistDto(
            $lcrGatewayDto,
            $lcrGateway,
            true
        );

        $entity->setLcrGateway($lcrGateway);
    }
}