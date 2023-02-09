<?php

namespace Ivoz\Provider\Application\Service\Friend;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

class FriendDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private UsersLocationRepository $usersLocationRepository,
        private RequestDateTimeResolver $requestDateTimeResolver
    ) {
    }

    /**
     * @param FriendInterface $friend
     * @throws \Exception
     */
    public function toDto(EntityInterface $friend, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($friend, FriendInterface::class);

        $dto = $friend->toDto($depth);

        if (FriendDto::CONTEXT_STATUS !== $context) {
            return $dto;
        }

        $domain = $friend->getDomain();
        if (!$domain) {
            return $dto;
        }

        $dto->setDomainName(
            $domain->getDomain()
        );

        $userLocations = $this
            ->usersLocationRepository
            ->findByUsernameAndDomain(
                $friend->getName(),
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
