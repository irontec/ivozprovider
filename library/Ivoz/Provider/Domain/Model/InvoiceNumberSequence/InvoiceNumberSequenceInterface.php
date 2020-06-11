<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @return integer
     */
    public function getSequenceLength(): int;

    /**
     * Get increment
     *
     * @return integer
     */
    public function getIncrement(): int;

    /**
     * Get latestValue
     *
     * @return string | null
     */
    public function getLatestValue();

    /**
     * Get iteration
     *
     * @return integer
     */
    public function getIteration(): int;

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
