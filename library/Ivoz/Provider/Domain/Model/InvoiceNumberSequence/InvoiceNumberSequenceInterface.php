<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* InvoiceNumberSequenceInterface
*/
interface InvoiceNumberSequenceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Update and return latest value
     *
     * @return string
     */
    public function nextval();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Get sequenceLength
     *
     * @return int
     */
    public function getSequenceLength(): int;

    /**
     * Get increment
     *
     * @return int
     */
    public function getIncrement(): int;

    /**
     * Get latestValue
     *
     * @return string | null
     */
    public function getLatestValue(): ?string;

    /**
     * Get iteration
     *
     * @return int
     */
    public function getIteration(): int;

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion(): int;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
