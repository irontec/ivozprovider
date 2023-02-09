<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait InvoiceSchedulerTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, FixedCostsRelInvoiceSchedulerInterface> & Selectable<array-key, FixedCostsRelInvoiceSchedulerInterface>
     * FixedCostsRelInvoiceSchedulerInterface mappedBy invoiceScheduler
     * orphanRemoval
     */
    protected $relFixedCosts;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relFixedCosts = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceSchedulerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relFixedCosts = $dto->getRelFixedCosts();
        if (!is_null($relFixedCosts)) {

            /** @var Collection<array-key, FixedCostsRelInvoiceSchedulerInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relFixedCosts
            );
            $self->replaceRelFixedCosts($replacement);
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
     * @param InvoiceSchedulerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relFixedCosts = $dto->getRelFixedCosts();
        if (!is_null($relFixedCosts)) {

            /** @var Collection<array-key, FixedCostsRelInvoiceSchedulerInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relFixedCosts
            );
            $this->replaceRelFixedCosts($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceSchedulerDto
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

    public function addRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface
    {
        $this->relFixedCosts->add($relFixedCost);

        return $this;
    }

    public function removeRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface
    {
        $this->relFixedCosts->removeElement($relFixedCost);

        return $this;
    }

    /**
     * @param Collection<array-key, FixedCostsRelInvoiceSchedulerInterface> $relFixedCosts
     */
    public function replaceRelFixedCosts(Collection $relFixedCosts): InvoiceSchedulerInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFixedCosts as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setInvoiceScheduler($this);
        }

        foreach ($this->relFixedCosts as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relFixedCosts->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relFixedCosts->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relFixedCosts->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelFixedCost($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FixedCostsRelInvoiceSchedulerInterface>
     */
    public function getRelFixedCosts(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relFixedCosts->matching($criteria)->toArray();
        }

        return $this->relFixedCosts->toArray();
    }
}
