<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait InvoiceTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, FixedCostsRelInvoiceInterface> & Selectable<array-key, FixedCostsRelInvoiceInterface>
     * FixedCostsRelInvoiceInterface mappedBy invoice
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
     * @param InvoiceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relFixedCosts = $dto->getRelFixedCosts();
        if (!is_null($relFixedCosts)) {

            /** @var Collection<array-key, FixedCostsRelInvoiceInterface> $replacement */
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
     * @param InvoiceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relFixedCosts = $dto->getRelFixedCosts();
        if (!is_null($relFixedCosts)) {

            /** @var Collection<array-key, FixedCostsRelInvoiceInterface> $replacement */
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
    public function toDto(int $depth = 0): InvoiceDto
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

    public function addRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface
    {
        $this->relFixedCosts->add($relFixedCost);

        return $this;
    }

    public function removeRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface
    {
        $this->relFixedCosts->removeElement($relFixedCost);

        return $this;
    }

    /**
     * @param Collection<array-key, FixedCostsRelInvoiceInterface> $relFixedCosts
     */
    public function replaceRelFixedCosts(Collection $relFixedCosts): InvoiceInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFixedCosts as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setInvoice($this);
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

    public function getRelFixedCosts(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relFixedCosts->matching($criteria)->toArray();
        }

        return $this->relFixedCosts->toArray();
    }
}
