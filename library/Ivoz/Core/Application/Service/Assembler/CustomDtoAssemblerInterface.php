<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Domain\Model\EntityInterface;

interface CustomDtoAssemblerInterface
{
    public function toDTO(EntityInterface $entity);
}