<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;

class CreateOrUpdateByTrunksCdr
{
    public function __construct(
        private EntityTools $entityTools,
        private RetailAccountRepository $retailAccountRepository,
        private ResidentialDeviceRepository $residentialDeviceRepository,
        private UserRepository $userRepository,
        private FriendRepository $friendRepository
    ) {
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
        /** @var BillableCallDto $billableCallDto */
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
            )->setDdiId(
                $trunksCdrDto->getDdiId()
            );

        $direction = $trunksCdrDto->getDirection();
        if ($direction) {
            $billableCallDto
                ->setDirection($direction);
        }

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

            /** @var RetailAccountInterface|null $retailAccount */
            $retailAccount = $this->retailAccountRepository->find(
                $trunksCdrDto->getRetailAccountId()
            );

            $endpointName = $retailAccount
                ? $retailAccount->getName()
                : null;

            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_RETAILACCOUNT)
                ->setEndpointId($trunksCdrDto->getRetailAccountId())
                ->setEndpointName($endpointName);
        }

        if ($trunksCdrDto->getResidentialDeviceId()) {

            /** @var ResidentialDeviceInterface|null $residentialDevice */
            $residentialDevice = $this->residentialDeviceRepository->find(
                $trunksCdrDto->getResidentialDeviceId()
            );

            $endpointName = $residentialDevice
                ? $residentialDevice->getName()
                : null;

            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_RESIDENTIALDEVICE)
                ->setEndpointId($trunksCdrDto->getResidentialDeviceId())
                ->setEndpointName($endpointName);
        }

        if ($trunksCdrDto->getUserId()) {

            /** @var UserInterface|null $user */
            $user = $this->userRepository->find(
                $trunksCdrDto->getUserId()
            );

            $endpointName = ($user && $user->getExtension())
                ? $user->getExtension()->getNumber()
                : null;

            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_USER)
                ->setEndpointId($trunksCdrDto->getUserId())
                ->setEndpointName($endpointName);
        }

        if ($trunksCdrDto->getFriendId()) {

            /** @var FriendInterface|null $friend */
            $friend = $this->friendRepository->find(
                $trunksCdrDto->getFriendId()
            );

            $endpointName = $friend
                ? $friend->getName()
                : null;

            $billableCallDto
                ->setEndpointType(BillableCallInterface::ENDPOINTTYPE_FRIEND)
                ->setEndpointId($trunksCdrDto->getFriendId())
                ->setEndpointName($endpointName);
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
