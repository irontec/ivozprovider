<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Service\CarrierServer\CarrierServerLifecycleEventHandlerInterface;

class UpdateByCarrierServer implements CarrierServerLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = 10;

    public function __construct(
        private EntityTools $entityTools
    ) {
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

        $this
            ->entityTools
            ->persistDto(
                $lcrGatewayDto,
                $lcrGateway,
                true
            );

        /** @var CarrierServerDto $carrierServerDto */
        $carrierServerDto = $this
            ->entityTools
            ->entityToDto(
                $carrierServer
            );

        $carrierServerDto
            ->setLcrGateway($lcrGatewayDto);

        $this
            ->entityTools
            ->persistDto(
                $carrierServerDto,
                $carrierServer
            );
    }
}
