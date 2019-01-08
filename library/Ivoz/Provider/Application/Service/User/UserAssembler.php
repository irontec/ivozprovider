<?php

namespace Ivoz\Provider\Application\Service\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserAssembler implements CustomEntityAssemblerInterface
{
    /**
     * @param DataTransferObjectInterface|UserDto $dto
     * @param EntityInterface|UserInterface $entity
     * @throws \Exception
     */
    public function fromDto(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($entity, UserInterface::class);

        $oldPass = $dto->getOldPass();
        if ($oldPass && !password_verify($oldPass, $entity->getPass())) {
            throw new \DomainException('Invalid password');
        }
        // There is not oldPass validation in klear, so, we can't do any further validation

        $entity->updateFromDto($dto, $fkTransformer);
    }
}
