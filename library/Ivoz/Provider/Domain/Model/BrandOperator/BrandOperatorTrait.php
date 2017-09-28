<?php

namespace Ivoz\Provider\Domain\Model\BrandOperator;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * BrandOperatorTrait
 * @codeCoverageIgnore
 */
trait BrandOperatorTrait
{
    /**
     * @var integer
     */
    protected $id;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());

    }

    /**
     * @return BrandOperatorDTO
     */
    public static function createDTO()
    {
        return new BrandOperatorDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandOperatorDTO
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
         * @var $dto BrandOperatorDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return BrandOperatorDTO
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
            'id' => $this->getId()
        ];
    }


}

