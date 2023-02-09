<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait DestinationTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var TpDestinationInterface
     * mappedBy destination
     */
    protected $tpDestination;

    /**
     * @var Collection<array-key, DestinationRateInterface> & Selectable<array-key, DestinationRateInterface>
     * DestinationRateInterface mappedBy destination
     */
    protected $destinationRates;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->destinationRates = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpDestination())) {
            /** @var TpDestinationInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpDestination()
            );
            $self->setTpDestination($entity);
        }

        $destinationRates = $dto->getDestinationRates();
        if (!is_null($destinationRates)) {

            /** @var Collection<array-key, DestinationRateInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $destinationRates
            );
            $self->replaceDestinationRates($replacement);
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
     * @param DestinationDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getTpDestination())) {
            /** @var TpDestinationInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getTpDestination()
            );
            $this->setTpDestination($entity);
        }

        $destinationRates = $dto->getDestinationRates();
        if (!is_null($destinationRates)) {

            /** @var Collection<array-key, DestinationRateInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $destinationRates
            );
            $this->replaceDestinationRates($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationDto
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

    public function setTpDestination(TpDestinationInterface $tpDestination): static
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    public function getTpDestination(): ?TpDestinationInterface
    {
        return $this->tpDestination;
    }

    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface
    {
        $this->destinationRates->add($destinationRate);

        return $this;
    }

    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface
    {
        $this->destinationRates->removeElement($destinationRate);

        return $this;
    }

    /**
     * @param Collection<array-key, DestinationRateInterface> $destinationRates
     */
    public function replaceDestinationRates(Collection $destinationRates): DestinationInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($destinationRates as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDestination($this);
        }

        foreach ($this->destinationRates as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->destinationRates->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->destinationRates->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->destinationRates->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addDestinationRate($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, DestinationRateInterface>
     */
    public function getDestinationRates(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->destinationRates->matching($criteria)->toArray();
        }

        return $this->destinationRates->toArray();
    }
}
