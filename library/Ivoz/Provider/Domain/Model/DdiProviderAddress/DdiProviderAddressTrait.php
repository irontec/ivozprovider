<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;

/**
* @codeCoverageIgnore
*/
trait DdiProviderAddressTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TrunksAddressInterface
     * mappedBy ddiProviderAddress
     */
    protected $trunksAddress;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());

    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderAddressDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTrunksAddress())) {
            $self->setTrunksAddress(
                $fkTransformer->transform(
                    $dto->getTrunksAddress()
                )
            );
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderAddressDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTrunksAddress())) {
            $this->setTrunksAddress(
                $fkTransformer->transform(
                    $dto->getTrunksAddress()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DdiProviderAddressDto
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

    /**
     * @var TrunksAddressInterface
     * mappedBy ddiProviderAddress
     */
    public function setTrunksAddress(TrunksAddressInterface $trunksAddress): DdiProviderAddressInterface
    {
        $this->trunksAddress = $trunksAddress;

        return $this;
    }

    /**
     * Get trunksAddress
     * @return TrunksAddressInterface
     */
    public function getTrunksAddress(): ?TrunksAddressInterface
    {
        return $this->trunksAddress;
    }

}
