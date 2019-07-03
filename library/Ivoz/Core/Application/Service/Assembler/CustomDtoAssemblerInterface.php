<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface CustomDtoAssemblerInterface
{
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface;
}
