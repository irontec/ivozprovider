<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait InvoiceTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelFixedCosts())) {
            $self->replaceRelFixedCosts(
                $fkTransformer->transformCollection(
                    $dto->getRelFixedCosts()
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
     * @param InvoiceDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelFixedCosts())) {
            $this->replaceRelFixedCosts(
                $fkTransformer->transformCollection(
                    $dto->getRelFixedCosts()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return InvoiceDto
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

    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts): InvoiceInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFixedCosts as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setInvoice($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relFixedCosts as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relFixedCosts->set($key, $updatedEntities[$identity]);
            } else {
                $this->relFixedCosts->remove($key);
            }
            unset($updatedEntities[$identity]);
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
