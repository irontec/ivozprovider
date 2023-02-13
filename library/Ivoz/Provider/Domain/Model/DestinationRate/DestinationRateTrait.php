<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

/**
* @codeCoverageIgnore
*/
trait DestinationRateTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var TpRateInterface
     * mappedBy destinationRate
     */
    protected $tpRate;

    /**
     * @var TpDestinationRateInterface
     * mappedBy destinationRate
     */
    protected $tpDestinationRate;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpRate())) {
            /** @var TpRateInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpRate()
            );
            $self->setTpRate($entity);
        }

        if (!is_null($dto->getTpDestinationRate())) {
            /** @var TpDestinationRateInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpDestinationRate()
            );
            $self->setTpDestinationRate($entity);
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
     * @param DestinationRateDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpRate())) {
            /** @var TpRateInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpRate()
            );
            $this->setTpRate($entity);
        }

        if (!is_null($dto->getTpDestinationRate())) {
            /** @var TpDestinationRateInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpDestinationRate()
            );
            $this->setTpDestinationRate($entity);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationRateDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function setTpRate(TpRateInterface $tpRate): static
    {
        $this->tpRate = $tpRate;

        return $this;
    }

    public function getTpRate(): ?TpRateInterface
    {
        return $this->tpRate;
    }

    public function setTpDestinationRate(TpDestinationRateInterface $tpDestinationRate): static
    {
        $this->tpDestinationRate = $tpDestinationRate;

        return $this;
    }

    public function getTpDestinationRate(): ?TpDestinationRateInterface
    {
        return $this->tpDestinationRate;
    }
}
