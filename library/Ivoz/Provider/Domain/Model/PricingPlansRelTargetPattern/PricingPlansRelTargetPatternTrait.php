<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * PricingPlansRelTargetPatternTrait
 * @codeCoverageIgnore
 */
trait PricingPlansRelTargetPatternTrait
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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PricingPlansRelTargetPatternDto
         */
        $self = parent::fromDto($dto);

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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PricingPlansRelTargetPatternDto
         */
        parent::updateFromDto($dto);

        return $this;
    }

    /**
     * @param int $depth
     * @return PricingPlansRelTargetPatternDto
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

