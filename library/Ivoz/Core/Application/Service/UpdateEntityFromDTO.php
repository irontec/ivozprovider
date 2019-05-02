<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
 * @deprecated
 */
class UpdateEntityFromDTO
{
    /**
     * @var EntityAssembler
     */
    private $entityAssembler;

    public function __construct(
        EntityAssembler $entityAssembler
    ) {
        $this->entityAssembler = $entityAssembler;
    }

    /**
     * @return void
     */
    public function execute(EntityInterface $entity, DataTransferObjectInterface $dto)
    {
        //Ensure that we don't propagate applied changes
        $dto = clone $dto;

        $this->entityAssembler->updateFromDto(
            $dto,
            $entity
        );
    }
}
