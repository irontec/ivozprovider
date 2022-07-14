<?php

namespace Ivoz\Provider\Application\Service\ResidentialDevice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;

class ResidentialDeviceDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private UsersLocationRepository $usersLocationRepository,
        private RequestDateTimeResolver $requestDateTimeResolver
    ) {
    }

    /**
     * @param ResidentialDeviceInterface $residentialDevice
     * @throws \Exception
     */
    public function toDto(EntityInterface $residentialDevice, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($residentialDevice, ResidentialDeviceInterface::class);

        $dto = $residentialDevice->toDto($depth);

        $statusContexts = [
            ResidentialDeviceDto::CONTEXT_STATUS,
            ResidentialDeviceDto::CONTEXT_COLLECTION,
        ];

        if (!in_array($context, $statusContexts)) {
            return $dto;
        }

        $domain = $residentialDevice->getDomain();
        if (!$domain) {
            return $dto;
        }

        $dto->setDomainName(
            $domain->getDomain()
        );

        $userLocations = $this
            ->usersLocationRepository
            ->findByUsernameAndDomain(
                $residentialDevice->getName(),
                $domain->getDomain()
            );

        foreach ($userLocations as $userLocation) {
            $dto->addStatus(
                new RegistrationStatus(
                    $userLocation,
                    $this->requestDateTimeResolver->getTimezone()
                )
            );
        }

        return $dto;
    }
}
