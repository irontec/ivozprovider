<?php

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

/**
 * ChannelUsage
 *
 * Note: getChangeSet() is deliberately NOT exposed here. The interface regenerator picks the
 * parent interface by reflecting on this class, so omitting it makes ChannelUsageInterface
 * extend EntityInterface instead of LoggableEntityInterface, which keeps this high-volume
 * historic table out of the changelog. Do not add getChangeSet() back "for consistency" with
 * the other entities: it would start writing an audit row per bucket per company.
 */
class ChannelUsage extends ChannelUsageAbstract implements ChannelUsageInterface
{
    use ChannelUsageTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        $company = $this->getCompany();
        $brand = $this->getBrand();

        $companyBrand = $company->getBrand();

        if ($brand->getId() !== $companyBrand->getId()) {
            throw new \DomainException(
                'Company does not belong to the specified brand'
            );
        }

        if ($this->getClosingUsage() > $this->getPeak()) {
            throw new \DomainException(
                'Closing usage cannot be greater than the bucket peak'
            );
        }

        // Tolerance: avgUsage is a rounded time-weighted mean, so it can land a hair above
        // the peak in the last decimal without the value being actually wrong.
        if ($this->getAvgUsage() > (float) $this->getPeak() + 0.01) {
            throw new \DomainException(
                'Average usage cannot be greater than the bucket peak'
            );
        }
    }
}
