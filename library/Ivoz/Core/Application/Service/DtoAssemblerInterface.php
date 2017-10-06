<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface DtoAssemblerInterface
{
    public function toDTO(EntityInterface $entity);
}