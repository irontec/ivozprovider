<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * LcrGatewayTrait
 * @codeCoverageIgnore
 */
trait LcrGatewayTrait
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
     * @return LcrGatewayDTO
     */
    public static function createDTO()
    {
        return new LcrGatewayDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrGatewayDTO
         */
        $self = parent::fromDTO($dto);

        if ($dto->getId()) {
            $self->id = $dto->getId();
        }
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrGatewayDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return LcrGatewayDTO
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

