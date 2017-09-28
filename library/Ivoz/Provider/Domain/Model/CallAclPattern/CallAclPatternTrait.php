<?php

namespace Ivoz\Provider\Domain\Model\CallAclPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * CallAclPatternTrait
 * @codeCoverageIgnore
 */
trait CallAclPatternTrait
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
     * @return CallAclPatternDTO
     */
    public static function createDTO()
    {
        return new CallAclPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclPatternDTO
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
         * @var $dto CallAclPatternDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return CallAclPatternDTO
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

