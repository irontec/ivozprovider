<?php
/**
 * Created by PhpStorm.
 * User: mikel
 * Date: 11/12/17
 * Time: 10:53
 */

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
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

    /**
     * @var EntityAssembler
     */
    private $entityAssembler;

    public function __construct(
        ForeignKeyTransformerInterface $fkTransformer,
        CollectionTransformerInterface $collectionTransformer,
        EntityAssembler $entityAssembler
    ) {
        $this->fkTransformer = $fkTransformer;
        $this->collectionTransformer = $collectionTransformer;
        $this->entityAssembler = $entityAssembler;
    }

    public function execute(EntityInterface $entity, DataTransferObjectInterface $dto)
    {
        //Ensure that we don't propagate applied changes
        $dto = clone $dto;
        $dto->transformForeignKeys($this->fkTransformer);
        $dto->transformCollections($this->collectionTransformer);

        $this->entityAssembler->updateFromDto(
            $dto,
            $entity
        );
    }
}