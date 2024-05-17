<?php

namespace Ivoz\Provider\Domain\Assembler\Fax;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxDto;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUserInterface;

class FaxDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param FaxInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, FaxInterface::class);

        $dto = $entity->toDto($depth);

        if (in_array($context, FaxDto::CONTEXTS_WITH_REL_USERS, true)) {
            /** @var array<int> $userIds */
            $userIds = array_map(
                function (FaxesRelUserInterface $faxesRelUser) {
                    return $faxesRelUser
                        ->getUser()
                        ->getId();
                },
                $entity->getFaxesRelUsers()
            );

            if ($userIds) {
                $dto->setRelUserIds($userIds);
            }
        }

        return $dto;
    }
}
