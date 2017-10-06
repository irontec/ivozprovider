<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface EntityAssemblerInterface
{
    public function fromDTO(DataTransferObjectInterface $dto, EntityInterface $entity);
}