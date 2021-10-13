<?php

namespace Ivoz\Provider\Domain\Model\Currency;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CurrencyInterface
*/
interface CurrencyInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getIden(): string;

    public function getSymbol(): string;

    public function getName(): Name;

    public function isInitialized(): bool;
}
