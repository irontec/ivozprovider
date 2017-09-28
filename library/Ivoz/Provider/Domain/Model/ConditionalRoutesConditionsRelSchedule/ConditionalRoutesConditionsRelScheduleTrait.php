<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ConditionalRoutesConditionsRelScheduleTrait
 * @codeCoverageIgnore
 */
trait ConditionalRoutesConditionsRelScheduleTrait
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
     * @return ConditionalRoutesConditionsRelScheduleDTO
     */
    public static function createDTO()
    {
        return new ConditionalRoutesConditionsRelScheduleDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRoutesConditionsRelScheduleDTO
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
         * @var $dto ConditionalRoutesConditionsRelScheduleDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelScheduleDTO
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

