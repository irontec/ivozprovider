<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ConditionalRoutesConditionsRelMatchlistTrait
 * @codeCoverageIgnore
 */
trait ConditionalRoutesConditionsRelMatchlistTrait
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
     * @return ConditionalRoutesConditionsRelMatchlistDTO
     */
    public static function createDTO()
    {
        return new ConditionalRoutesConditionsRelMatchlistDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRoutesConditionsRelMatchlistDTO
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
         * @var $dto ConditionalRoutesConditionsRelMatchlistDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelMatchlistDTO
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

