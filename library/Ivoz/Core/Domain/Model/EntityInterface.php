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
     * Factory method
     * @param DataTransferObjectInterface $dto
     */
    public static function fromDTO(DataTransferObjectInterface $dto);

    /**
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto);

    /**
     * DTO casting
     * @return DataTransferObjectInterface
     */
    public function toDTO();

    /**
     * @return DataTransferObjectInterface
     */
    public static function createDTO();
}
