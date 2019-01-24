<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

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
     * @return BillableCall
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
            : $billableCallDto->getCarrierName();

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
                ->setEndpointType('RetailAccount')
                ->setEndpointId($trunksCdrDto->getRetailAccountId());
        }

        $billableCall = $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            false
        );

        return $billableCall;
    }
}
