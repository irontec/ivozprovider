<?php

namespace Ivoz\Provider\Application\Service\CarrierServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Kam\Infrastructure\Persistence\Doctrine\TrunksLcrGatewayDoctrineRepository;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerRegistrationStatus;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;

class CarrierServerDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private TrunksLcrGatewayDoctrineRepository $trunksLcrGatewayDoctrineRepository,
        private TrunksClientInterface $trunksClient
    ) {
    }

    public function toDto(
        EntityInterface $entity,
        int $depth = 0,
        string $context = null
    ): DataTransferObjectInterface {
        Assertion::isInstanceOf(
            $entity,
            CarrierServerInterface::class
        );

        $carrierServerDto = $entity->toDto($depth);

        if (is_null($carrierServerDto->getId())) {
            return $carrierServerDto;
        }

        /** @var ?TrunksLcrGatewayInterface $kamTrunksLcrGateway */
        $kamTrunksLcrGateway = $this
            ->trunksLcrGatewayDoctrineRepository
            ->find(
                $carrierServerDto
                    ->getId()
            );

        if (is_null($kamTrunksLcrGateway)) {
            return $carrierServerDto;
        }

        try {
            $lcrGatewayInfo = $this->trunksClient->getLcrGatewayInfo(
                $kamTrunksLcrGateway->getId()
            );
        } catch (\Exception $e) {
            return $carrierServerDto;
        }

        $showStatus = $context == TerminalDto::CONTEXT_STATUS;
        $status = $lcrGatewayInfo['state'] ?? '';

        if (!$showStatus) {
            return $carrierServerDto;
        }

         $carrierServerDto->addStatus(
             new CarrierServerRegistrationStatus(
                 (int) $status
             )
         );

        return $carrierServerDto;
    }
}
