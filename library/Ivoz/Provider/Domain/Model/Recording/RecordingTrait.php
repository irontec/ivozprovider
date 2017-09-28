<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * RecordingTrait
 * @codeCoverageIgnore
 */
trait RecordingTrait
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
     * @return RecordingDTO
     */
    public static function createDTO()
    {
        return new RecordingDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RecordingDTO
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
         * @var $dto RecordingDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return RecordingDTO
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

