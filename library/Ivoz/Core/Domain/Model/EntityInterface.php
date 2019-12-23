<?php

namespace Ivoz\Core\Domain\Model;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
 * Entity interface
 *
 * @author Mikel Madariaga <mikel@irontec.com>
 */
interface EntityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return bool
     */
    public function isNew();

    /**
     * @return bool
     */
    public function isPersisted();

    /**
     * @return void
     */
    public function markAsPersisted();

    /**
     * @return bool
     */
    public function hasBeenDeleted();

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return void
     * @throws \Exception
     */
    public function initChangelog();

    /**
     * @param string $fieldName
     * @return boolean
     * @throws \Exception
     */
    public function hasChanged($fieldName);

    /**
     * @return string[]
     */
    public function getChangedFields();

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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    );

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    );

    /**
     * DTO casting
     * @param int $depth
     * @return DataTransferObjectInterface
     * @todo move this into dto::fromEntity
     */
    public function toDto($depth = 0);
}
