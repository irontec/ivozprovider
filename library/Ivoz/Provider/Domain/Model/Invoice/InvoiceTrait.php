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

    /**
     * @return array<string, mixed>
     */
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
        foreach ($relFixedCosts as $entity) {
            $entity->setInvoice($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relFixedCosts as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($relFixedCosts as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($relFixedCosts[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relFixedCosts->remove($key);
            }
        }

        foreach ($relFixedCosts as $entity) {
            $this->addRelFixedCost($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FixedCostsRelInvoiceInterface>
     */
    public function getRelFixedCosts(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relFixedCosts->matching($criteria)->toArray();
        }

        return $this->relFixedCosts->toArray();
    }
}
