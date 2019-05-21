<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Service\CarrierServer\CarrierServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;

class UpdateByCarrierServer implements CarrierServerLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = 10;

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

    /**
     * @return void
     */
    public function execute(CarrierServerInterface $carrierServer)
    {
        $lcrGateway = $carrierServer->getLcrGateway();

        /** @var TrunksLcrGatewayDto $lcrGatewayDto */
        $lcrGatewayDto = is_null($lcrGateway)
            ? TrunksLcrGateway::createDto()
            : $lcrGateway->toDto();

        // Update/Create LcrGateway for this CarrierServer
        $lcrGatewayDto
            ->setGwName($carrierServer->getName())
            ->setIp($carrierServer->getIp())
            ->setHostname($carrierServer->getHostname())
            ->setPort($carrierServer->getPort())
            ->setUriScheme($carrierServer->getUriScheme())
            ->setTransport($carrierServer->getTransport())
            ->setCarrierServerId($carrierServer->getId());

        $lcrGateway = $this->entityTools->persistDto(
            $lcrGatewayDto,
            $lcrGateway,
            true
        );

        $carrierServer->setLcrGateway($lcrGateway);
        $this->entityTools->persist($carrierServer);
    }
}
