<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ExternalCallFilterBlackListTrait
 * @codeCoverageIgnore
 */
trait ExternalCallFilterBlackListTrait
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
     * @return ExternalCallFilterBlackListDTO
     */
    public static function createDTO()
    {
        return new ExternalCallFilterBlackListDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterBlackListDTO
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
         * @var $dto ExternalCallFilterBlackListDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return ExternalCallFilterBlackListDTO
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

