<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * FriendsPatternTrait
 * @codeCoverageIgnore
 */
trait FriendsPatternTrait
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
     * @return FriendsPatternDTO
     */
    public static function createDTO()
    {
        return new FriendsPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FriendsPatternDTO
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
         * @var $dto FriendsPatternDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return FriendsPatternDTO
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

