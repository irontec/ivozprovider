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
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function toDto($depth = 0): DdiProviderRegistrationDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function setTrunksUacreg(TrunksUacregInterface $trunksUacreg): static
    {
        $this->trunksUacreg = $trunksUacreg;

        return $this;
    }

    public function getTrunksUacreg(): ?TrunksUacregInterface
    {
        return $this->trunksUacreg;
    }
}
