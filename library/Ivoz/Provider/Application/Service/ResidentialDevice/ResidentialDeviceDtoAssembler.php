<?php

namespace Ivoz\Provider\Application\Service\ResidentialDevice;

use Ivoz\Api\Entity\Serializer\Normalizer\DateTimeNormalizerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Kam\Domain\Model\UsersLocation\Status;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Assert\Assertion;

class ResidentialDeviceDtoAssembler implements CustomDtoAssemblerInterface
{
    protected $usersLocationRepository;
    protected $requestDateTimeResolver;

    public function __construct(
        UsersLocationRepository $usersLocationRepository,
        RequestDateTimeResolver $requestDateTimeResolver
    ) {
        $this->usersLocationRepository = $usersLocationRepository;
        $this->requestDateTimeResolver = $requestDateTimeResolver;
    }

    /**
     * @param ResidentialDeviceInterface $residentialDevice
     * @param integer $depth
     * @return ResidentialDeviceDto
     */
    public function toDto(EntityInterface $residentialDevice, $depth = 0, string $context = null)
    {
        Assertion::isInstanceOf($residentialDevice, ResidentialDeviceInterface::class);

        /** @var ResidentialDeviceDto $dto */
        $dto = $residentialDevice->toDto($depth);

        if (ResidentialDeviceDto::CONTEXT_STATUS !== 'status') {
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
                new Status(
                    $userLocation,
                    $this->requestDateTimeResolver->getTimezone()
                )
            );
        }

        return $dto;
    }
}
