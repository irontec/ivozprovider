<?php

namespace Ivoz\Provider\Domain\Assembler\Terminal;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

class TerminalDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private UsersLocationRepository $usersLocationRepository,
        private RequestDateTimeResolver $requestDateTimeResolver
    ) {
    }

    /**
     * @param TerminalInterface $terminal
     * @throws \Exception
     */
    public function toDto(EntityInterface $terminal, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($terminal, TerminalInterface::class);

        $dto = $terminal->toDto($depth);

        $showStatus = in_array(
            $context,
            [
                TerminalDto::CONTEXT_STATUS,
                TerminalDto::CONTEXT_COLLECTION,
                TerminalDto::CONTEXT_DETAILED,
            ]
        );

        $showDomainName = in_array(
            $context,
            [
                TerminalDto::CONTEXT_STATUS,
                TerminalDto::CONTEXT_COLLECTION,
            ]
        );

        if (!$showStatus && !$showDomainName) {
            return $dto;
        }

        $domain = $terminal->getDomain();
        if ($domain && $showDomainName) {
            $dto->setDomainName(
                $domain->getDomain()
            );
        }

        if (!$showStatus || !$domain) {
            return $dto;
        }

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
