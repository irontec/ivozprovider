<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

/**
 * FixedCostsRelInvoiceScheduler
 */
class FixedCostsRelInvoiceScheduler extends FixedCostsRelInvoiceSchedulerAbstract implements FixedCostsRelInvoiceSchedulerInterface
{
    use FixedCostsRelInvoiceSchedulerTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
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

    protected function sanitizeValues(): void
    {
        if ($this->getType() !== self::TYPE_STATIC) {
            $this->setQuantity(null);
        }
        if ($this->getType() !== self::TYPE_DDIS) {
            $this->setDdisCountryMatch(null);
            $this->setDdisCountry(null);
        }

        // Check DDIs Country is set in specific match
        if (
            $this->getType() === self::TYPE_DDIS &&
            $this->getDdisCountryMatch() == self::DDISCOUNTRYMATCH_SPECIFIC &&
            !$this->getDdisCountry()
        ) {
            throw new \DomainException(
                'DdisCountry is required for specific ddis type fixed costs',
            );
        }
    }
}
