<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

/**
 * BillableCall
 */
class BillableCall extends BillableCallAbstract implements BillableCallInterface
{
    use BillableCallTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function isOutboundCall(): bool
    {
        return $this->getDirection() === self::DIRECTION_OUTBOUND;
    }

    protected function sanitizeValues(): void
    {
        if ($this->getPrice() < 0) {
            throw new \DomainException(
                'Negative prices are not allowed',
                500
            );
        }

        $priceChanged = $this->hasChanged('price');

        if ($priceChanged && $this->getInvoice()) {
            throw new \DomainException(
                'Call already invoiced, unable to change the price',
                500
            );
        }

        parent::sanitizeValues();
    }
}
