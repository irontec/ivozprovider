<?php

namespace Ivoz\Core\Application\Command;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

class UpdateEntityFromDTO
{
    /**
     * @var ForeignKeyTransformerInterface
     */
    private $fkTransformer;

    /**
     * @var CollectionTransformerInterface
     */
    private $collectionTransformer;

    public function __construct(
        ForeignKeyTransformerInterface $fkTransformer,
        CollectionTransformerInterface $collectionTransformer
    ) {
        $this->fkTransformer = $fkTransformer;
        $this->collectionTransformer = $collectionTransformer;
    }

    public function execute(EntityInterface $entity, DataTransferObjectInterface $dto)
    {
        //Ensure that we don't propagate applied changes
        $dto = clone $dto;
        $dto->transformForeignKeys($this->fkTransformer);
        $dto->transformCollections($this->collectionTransformer);

        $entity->updateFromDTO($dto);
    }
}