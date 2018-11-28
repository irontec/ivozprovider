<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * InvoiceTrait
 * @codeCoverageIgnore
 */
trait InvoiceTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
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

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto InvoiceDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getRelFixedCosts()) {
            $self->replaceRelFixedCosts($dto->getRelFixedCosts());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto InvoiceDto
         */
        parent::updateFromDto($dto);
        if ($dto->getRelFixedCosts()) {
            $this->replaceRelFixedCosts($dto->getRelFixedCosts());
        }
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
    /**
     * Add relFixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost
     *
     * @return InvoiceTrait
     */
    public function addRelFixedCost(\Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost)
    {
        $this->relFixedCosts->add($relFixedCost);

        return $this;
    }

    /**
     * Remove relFixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost
     */
    public function removeRelFixedCost(\Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost)
    {
        $this->relFixedCosts->removeElement($relFixedCost);
    }

    /**
     * Replace relFixedCosts
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface[] $relFixedCosts
     * @return self
     */
    public function replaceRelFixedCosts(Collection $relFixedCosts)
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

    /**
     * Get relFixedCosts
     *
     * @return \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface[]
     */
    public function getRelFixedCosts(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relFixedCosts->matching($criteria)->toArray();
        }

        return $this->relFixedCosts->toArray();
    }
}
