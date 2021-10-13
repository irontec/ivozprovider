<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* InvoiceNumberSequenceInterface
*/
interface InvoiceNumberSequenceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Update and return latest value
     *
     * @return string
     */
    public function nextval(): ?string;

    public function getName(): string;

    public function getPrefix(): string;

    public function getSequenceLength(): int;

    public function getIncrement(): int;

    public function getLatestValue(): ?string;

    public function getIteration(): int;

    public function getVersion(): int;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;
}
