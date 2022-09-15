<?php

namespace Ivoz\Provider\Application\Service\DdiProviderRegistration;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\DdiProviderRegistrationStatus;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Psr\Log\LoggerInterface;

class DdiProviderRegistrationDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private TrunksClientInterface $trunksClient,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param DdiProviderRegistrationInterface $ddiProviderRegistration
     * @throws \Exception
     */
    public function toDto(EntityInterface $ddiProviderRegistration, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($ddiProviderRegistration, DdiProviderRegistrationInterface::class);

        $dto = $ddiProviderRegistration->toDto($depth);

        if (DdiProviderRegistrationDto::CONTEXT_DETAILED_COLLECTION !== $context) {
            return $dto;
        }

        $trunksUacreg = $ddiProviderRegistration->getTrunksUacreg();

        try {
            $uacRegistrationInfo = $this->trunksClient->getUacRegistrationInfo(
                $trunksUacreg->getLUuid()
            );

            $statusCode = $uacRegistrationInfo['flags'] ?? -1;
            $expires = $uacRegistrationInfo['diff_expires'] ?? null;

            $dto->setStatus(
                new DdiProviderRegistrationStatus(
                    $statusCode,
                    $expires
                )
            );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );
        }

        return $dto;
    }
}
