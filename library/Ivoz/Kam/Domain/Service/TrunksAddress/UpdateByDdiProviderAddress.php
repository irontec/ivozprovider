<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressDto;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;
use Ivoz\Provider\Domain\Service\DdiProviderAddress\DdiProviderAddressLifecycleEventHandlerInterface;

/**
 * Class UpdateByDdiProviderAddress
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class UpdateByDdiProviderAddress implements DdiProviderAddressLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

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
    public function execute(DdiProviderAddressInterface $ddiProviderAddress)
    {
        $trunksAddress = $ddiProviderAddress->getTrunksAddress();

        /** @var TrunksAddressDto $trunksAddressDto */
        $trunksAddressDto = ($trunksAddress)
            ? $this->entityTools->entityToDto($trunksAddress)
            : new TrunksAddressDto();

        // Update/Create Trunks Address for this DDI Provider Address
        $trunksAddressDto
            ->setIpAddr($ddiProviderAddress->getIp())
            ->setGrp($ddiProviderAddress->getDdiProvider()->getId())
            ->setDdiProviderAddressId($ddiProviderAddress->getId());

        $this->entityTools->persistDto(
            $trunksAddressDto,
            $trunksAddress,
            true
        );

        /** @var DdiProviderAddressDto $ddiProviderAddressDto */
        $ddiProviderAddressDto = $this->entityTools->entityToDto(
            $ddiProviderAddress
        );

        $ddiProviderAddressDto
            ->setTrunksAddress($trunksAddressDto);

        $this
            ->entityTools
            ->persistDto(
                $ddiProviderAddressDto,
                $ddiProviderAddress
            );
    }
}
