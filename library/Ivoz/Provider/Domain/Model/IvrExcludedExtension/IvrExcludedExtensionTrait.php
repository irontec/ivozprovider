<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * IvrExcludedExtensionTrait
 * @codeCoverageIgnore
 */
trait IvrExcludedExtensionTrait
{
    /**
     * @var integer
     */
    protected $id;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());

    }

    /**
     * @return IvrExcludedExtensionDTO
     */
    public static function createDTO()
    {
        return new IvrExcludedExtensionDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrExcludedExtensionDTO
         */
        $self = parent::fromDTO($dto);

        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrExcludedExtensionDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return IvrExcludedExtensionDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }


}

