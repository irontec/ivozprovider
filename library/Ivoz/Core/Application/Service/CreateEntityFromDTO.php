<?php
/**
 * Created by PhpStorm.
 * User: mikel
 * Date: 11/12/17
 * Time: 10:52
 */

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * @deprecated
 */
class CreateEntityFromDTO
{
    /**
     * @var EntityAssembler
     */
    private $entityAssembler;

    public function __construct(
        EntityAssembler $entityAssembler
    ) {
        $this->entityAssembler = $entityAssembler;
    }

    /**
     * @param string $entityName
     * @param DataTransferObjectInterface $dto
     * @return EntityInterface
     */
    public function execute($entityName, DataTransferObjectInterface $dto)
    {
        //Ensure that we don't propagate applied changes
        $dto = clone $dto;

        return $this->entityAssembler->createFromDto(
            $dto,
            $entityName
        );
    }
}
