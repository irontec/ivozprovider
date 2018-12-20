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
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\Currency\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\Name
     */
    public function getName();
}
