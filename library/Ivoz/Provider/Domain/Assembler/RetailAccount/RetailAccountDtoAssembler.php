<?php

namespace Ivoz\Provider\Domain\Assembler\RetailAccount;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

class RetailAccountDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private UsersLocationRepository $usersLocationRepository,
        private RequestDateTimeResolver $requestDateTimeResolver
    ) {
    }

    /**
     * @param RetailAccountInterface $retailAccount
     * @throws \Exception
     */
    public function toDto(EntityInterface $retailAccount, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($retailAccount, RetailAccountInterface::class);

        $dto = $retailAccount->toDto($depth);

        $domain = $retailAccount->getDomain();
        if (!$domain) {
            return $dto;
        }

        $dto->setDomainName(
            $domain->getDomain()
        );

        $userLocations = $this
            ->usersLocationRepository
            ->findByUsernameAndDomain(
                $retailAccount->getName(),
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
