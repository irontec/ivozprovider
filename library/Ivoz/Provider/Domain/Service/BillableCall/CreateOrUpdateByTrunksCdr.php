<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

class CreateOrUpdateByTrunksCdr
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    /**
     * @param TrunksCdrInterface $trunksCdr
     * @param BillableCallInterface $billableCall
     *
     * @return BillableCallInterface
     */
    public function execute(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall = null
    ) {
        $billableCallDto = $billableCall
            ? $this->entityTools->entityToDto($billableCall)
            : BillableCall::createDto();

        $carrier = $trunksCdr->getCarrier();

        $carrierName = $carrier
            ? $carrier->getName()
            : $billableCallDto->getCarrierName();

        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );

        $ddi = $trunksCdr->getDdi();

        $isOutbound = $trunksCdrDto->getDirection() === TrunksCdrInterface::DIRECTION_OUTBOUND;

        if ($isOutbound && !is_null($ddi)) {
            $caller = $ddi->getDdie164();
        } else {
            $caller = $trunksCdrDto->getCaller();
        }

        $billableCallDto
            ->setTrunksCdrId(
                $trunksCdrDto->getId()
            )->setBrandId(
                $trunksCdrDto->getBrandId()
            )->setCompanyId(
                $trunksCdrDto->getCompanyId()
            )->setCarrierId(
                $trunksCdrDto->getCarrierId()
            )->setDdiProviderId(
                $trunksCdrDto->getDdiProviderId()
            )->setCarrierName(
                $carrierName
            )->setCallid(
                $trunksCdrDto->getCallid()
            )->setCaller(
                $caller
            )->setDirection(
                $trunksCdrDto->getDirection()
            )->setDdiId(
                $trunksCdrDto->getDdiId()
            );

        $isNew = is_null($billableCall);
        if ($isNew) {
            $durantion = round(
                $trunksCdrDto->getDuration()
            );

            $billableCallDto
                ->setCallee(
                    $trunksCdrDto->getCallee()
                )->setStartTime(
                    $trunksCdrDto->getStartTime()
                )->setDuration(
                    $durantion
                );
        }

        if ($trunksCdrDto->getRetailAccountId()) {
            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_RETAILACCOUNT)
                ->setEndpointId($trunksCdrDto->getRetailAccountId());
        }

        if ($trunksCdrDto->getResidentialDeviceId()) {
            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_RESIDENTIALDEVICE)
                ->setEndpointId($trunksCdrDto->getResidentialDeviceId());
        }

        if ($trunksCdrDto->getUserId()) {
            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_USER)
                ->setEndpointId($trunksCdrDto->getUserId());
        }

        if ($trunksCdrDto->getFriendId()) {
            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_FRIEND)
                ->setEndpointId($trunksCdrDto->getFriendId());
        }

        if ($trunksCdrDto->getFaxId()) {
            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_FAX)
                ->setEndpointId($trunksCdrDto->getFaxId());
        }

        /** @var BillableCallInterface $billableCall */
        $billableCall = $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            false
        );

        return $billableCall;
    }
}
