<?php

namespace Ivoz\Provider\Domain\Model\Currency;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getIden();

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\Name
     */
    public function getName();
}
