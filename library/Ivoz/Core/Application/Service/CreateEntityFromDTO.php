<?php
/**
 * Created by PhpStorm.
 * User: mikel
 * Date: 11/12/17
 * Time: 10:52
 */

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;

class CreateEntityFromDTO
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

    /**
     * @param $entityName
     * @param DataTransferObjectInterface $dto
     * @return EntityInterface
     */
    public function execute($entityName, DataTransferObjectInterface $dto)
    {
        //Ensure that we don't propagate applied changes
        $dto = clone $dto;
        $dto->transformForeignKeys($this->fkTransformer);
        $dto->transformCollections($this->collectionTransformer);

        return $this->entityAssembler->createFromDto(
            $dto,
            $entityName
        );
    }
}