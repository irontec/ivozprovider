<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * UsersDomainAttrTrait
 * @codeCoverageIgnore
 */
trait UsersDomainAttrTrait
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
     * @return UsersDomainAttrDTO
     */
    public static function createDTO()
    {
        return new UsersDomainAttrDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersDomainAttrDTO
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
         * @var $dto UsersDomainAttrDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return UsersDomainAttrDTO
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

