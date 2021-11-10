<?php

namespace Ivoz\Provider\Application\Service\User;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUser;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param UserInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, UserInterface::class);

        $dto = $entity->toDto($depth);

        if (in_array($context, UserDto::CONTEXTS_WITH_PICKUP_GROUPS, true)) {
            $pickupGroupIds = array_map(
                function (PickUpRelUser $relFeature) {
                    return $relFeature
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
