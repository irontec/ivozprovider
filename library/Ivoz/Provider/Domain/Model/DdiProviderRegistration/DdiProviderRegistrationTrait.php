<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

/**
* @codeCoverageIgnore
*/
trait DdiProviderRegistrationTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TrunksUacregInterface
     * mappedBy ddiProviderRegistration
     */
    protected $trunksUacreg;

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
     * @param DdiProviderRegistrationDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTrunksUacreg())) {
            $self->setTrunksUacreg(
                $fkTransformer->transform(
                    $dto->getTrunksUacreg()
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
     * @param DdiProviderRegistrationDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTrunksUacreg())) {
            $this->setTrunksUacreg(
                $fkTransformer->transform(
                    $dto->getTrunksUacreg()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DdiProviderRegistrationDto
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

    public function setTrunksUacreg(TrunksUacregInterface $trunksUacreg): static
    {
        $this->trunksUacreg = $trunksUacreg;

        /** @var  $this */
        return $this;
    }

    public function getTrunksUacreg(): ?TrunksUacregInterface
    {
        return $this->trunksUacreg;
    }
}
