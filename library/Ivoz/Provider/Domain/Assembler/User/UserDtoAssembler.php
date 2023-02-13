<?php

namespace Ivoz\Provider\Domain\Assembler\User;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUser;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private UsersLocationRepository $usersLocationRepository,
        private RequestDateTimeResolver $requestDateTimeResolver
    ) {
    }


    /**
     * @param UserInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, UserInterface::class);

        $dto = $entity->toDto($depth);

        if ($context === DataTransferObjectInterface::CONTEXT_COLLECTION) {
            $terminal = $entity->getTerminal();
            if (!$terminal) {
                return $dto;
            }

            $domain = $terminal->getDomain();
            if (!$domain) {
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
        } elseif (in_array($context, UserDto::CONTEXTS_WITH_PICKUP_GROUPS, true)) {
            $pickupGroupIds = array_map(
                function (PickUpRelUser $relFeature) {
                    return (int) $relFeature
                        ->getPickUpGroup()
                        ->getId();
                },
                $entity->getPickUpRelUsers()
            );

            $dto->setPickupGroupIds(
                $pickupGroupIds
            );
        }

        return $dto;
    }
}
