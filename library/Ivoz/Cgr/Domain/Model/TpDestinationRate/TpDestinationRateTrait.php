<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TpDestinationRateTrait
 * @codeCoverageIgnore
 */
trait TpDestinationRateTrait
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TpDestinationRateDto
         */
        $self = parent::fromDto($dto, $fkTransformer);

        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TpDestinationRateDto
         */
        parent::updateFromDto($dto, $fkTransformer);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpDestinationRateDto
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
