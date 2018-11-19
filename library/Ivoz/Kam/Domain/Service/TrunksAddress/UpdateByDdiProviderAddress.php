<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;
use Ivoz\Provider\Domain\Service\DdiProviderAddress\DdiProviderAddressLifecycleEventHandlerInterface;

/**
 * Class UpdateByDdiProviderAddress
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class UpdateByDdiProviderAddress implements DdiProviderAddressLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

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

    public function execute(DdiProviderAddressInterface $ddiProviderAddress)
    {
        $trunksAddress = $ddiProviderAddress->getTrunksAddress();

        $trunksAddressDto = ($trunksAddress)
            ? $this->entityTools->entityToDto($trunksAddress)
            : new TrunksAddressDto();

        // Update/Create Trunks Address for this DDI Provider Address
        $trunksAddressDto
            ->setIpAddr($ddiProviderAddress->getIp())
            ->setGrp($ddiProviderAddress->getDdiProvider()->getId())
            ->setDdiProviderAddressId($ddiProviderAddress->getId());

        $trunksAddress = $this->entityTools->persistDto(
            $trunksAddressDto,
            $trunksAddress,
            true
        );

        $ddiProviderAddress
            ->setTrunksAddress($trunksAddress);

        $this->entityTools
            ->persist($ddiProviderAddress);
    }
}
