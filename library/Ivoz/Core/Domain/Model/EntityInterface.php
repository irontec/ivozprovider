<?php

namespace Ivoz\Core\Domain\Model;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * Entity interface
 *
 * @author Mikel Madariaga <mikel@irontec.com>
 */
interface EntityInterface
{
    public function getId();

    public function initChangelog();

    /**
     * @param string $fieldName
     * @return boolean
     * @throws \Exception
     */
    public function hasChanged($fieldName);

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function getInitialValue($fieldName);

    /**
     * @param mixed|null $id
     * @return EntityInterface
     */
    public static function createDto($id = null);

    /**
     * @param int $depth
     * @param EntityInterface|null $entity
     * @return DataTransferObjectInterface|null
     * @todo move this into dto::fromEntity
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0);

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto);

    /**
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto);

    /**
     * DTO casting
     * @param int $depth
     * @return DataTransferObjectInterface
     * @todo move this into dto::fromEntity
     */
    public function toDto($depth = 0);
}
