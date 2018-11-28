<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

class CreateOrUpdateDtoByTrunksCdr
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
     * @param TrunksCdrDto $trunksCdrDto
     *
     * @return BillableCallDto
     */
    public function execute(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall = null
    ) {
        $billableCallDto = $billableCall
            ? $this->entityTools->entityToDto($billableCall)
            : BillableCall::createDto();

        /**
         * @var CarrierInterface $carrier
         */
        $carrier = $trunksCdr->getCarrier();

        $carrierName = $carrier
            ? $carrier->getName()
            : '';

        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );

        $caller = $trunksCdrDto->getDiversion()
            ? $trunksCdrDto->getDiversion()
            : $trunksCdrDto->getCaller();

        $billableCallDto
            ->setTrunksCdrId(
                $trunksCdrDto->getId()
            )->setBrandId(
                $trunksCdrDto->getBrandId()
            )->setCompanyId(
                $trunksCdrDto->getCompanyId()
            )->setCarrierId(
                $trunksCdrDto->getCarrierId()
            )->setCarrierName(
                $carrierName
            )->setCallid(
                $trunksCdrDto->getCallid()
            )->setCaller(
                $caller
            )->setCallee(
                $trunksCdrDto->getCallee()
            )->setStartTime(
                $trunksCdrDto->getStartTime()
            )->setDuration(
                $trunksCdrDto->getDuration()
            );

        if ($trunksCdrDto->getRetailAccountId()) {
            $billableCallDto
                ->setEndpointType('RetailAccount')
                ->setEndpointId($trunksCdrDto->getRetailAccountId());
        }

        return $billableCallDto;
    }
}
