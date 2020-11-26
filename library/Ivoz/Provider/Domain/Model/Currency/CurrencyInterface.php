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
    public function getChangeSet();

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden(): string;

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol(): string;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
