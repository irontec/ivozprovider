<?php

namespace Ivoz\Provider\Domain\Assembler\Location;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Location\LocationInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class LocationDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param LocationInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, LocationInterface::class);

        $dto = $entity->toDto($depth);

        $userIds = array_map(
            function (UserInterface $user) {
                return (int) $user
                    ->getId();
            },
            $entity->getUsers()
        );

        $dto->setUserIds(
            $userIds
        );

        return $dto;
    }
}
