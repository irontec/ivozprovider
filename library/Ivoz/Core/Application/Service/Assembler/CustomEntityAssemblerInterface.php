<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface CustomEntityAssemblerInterface
{
    public function fromDto(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    );
}
