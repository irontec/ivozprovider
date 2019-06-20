<?php

namespace Ivoz\Provider\Application\Service\Terminal;

use Ivoz\Api\Entity\Serializer\Normalizer\DateTimeNormalizerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Assert\Assertion;

class TerminalDtoAssembler implements CustomDtoAssemblerInterface
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
     * @param TerminalInterface $terminal
     * @throws \Exception
     */
    public function toDto(EntityInterface $terminal, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($terminal, TerminalInterface::class);

        /** @var TerminalDto $dto */
        $dto = $terminal->toDto($depth);

        if (TerminalDto::CONTEXT_STATUS !== 'status') {
            return $dto;
        }

        $domain = $terminal->getDomain();
        if (!$domain) {
            return $dto;
        }

        $dto->setDomainName(
            $domain->getDomain()
        );

        $userLocations = $this
            ->usersLocationRepository
            ->findByUsernameAndDomain(
                $terminal->getName(),
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
