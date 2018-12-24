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
     * Fake/Empty setter
     *
     * Version value is automatically handled by doctrine
     *
     * @inheritdoc
     */
    public function setVersion($version);

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
    public function getName();

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Get sequenceLength
     *
     * @return integer
     */
    public function getSequenceLength();

    /**
     * Get increment
     *
     * @return integer
     */
    public function getIncrement();

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
    public function getIteration();

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();
}
