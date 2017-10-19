<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

interface EntityPersisterInterface
{
    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface|null $entity
     * @return EntityInterface
     */
    public function persistDto(DataTransferObjectInterface $dto, EntityInterface $entity = null, $dispatchImmediately = true);

    /**
     * @param EntityInterface $entity
     * @param boolean $dispatchImmediately
     * @return void
     */
    public function persist(EntityInterface $entity = null, $dispatchImmediately = true);

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function remove(EntityInterface $entity);
}