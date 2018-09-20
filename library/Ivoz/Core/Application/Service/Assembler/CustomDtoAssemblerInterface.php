<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface CustomDtoAssemblerInterface
{
    /**
     * @param EntityInterface $entity
     * @param integer $depth
     * @return DataTransferObjectInterface
     */
    public function toDto(EntityInterface $entity, $depth = 0);
}
