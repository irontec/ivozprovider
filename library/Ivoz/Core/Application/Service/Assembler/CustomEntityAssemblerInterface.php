<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface CustomEntityAssemblerInterface
{
    public function fromDto(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        ForeignKeyTransformerInterface $fkTransformer
    );
}
