<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * PickUpRelUserTrait
 * @codeCoverageIgnore
 */
trait PickUpRelUserTrait
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
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PickUpRelUserDto
         */
        $self = parent::fromDto($dto);

        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PickUpRelUserDto
         */
        parent::updateFromDto($dto);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return PickUpRelUserDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
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
