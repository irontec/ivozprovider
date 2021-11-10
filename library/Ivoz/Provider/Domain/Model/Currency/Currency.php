<?php

namespace Ivoz\Provider\Domain\Model\Currency;

/**
 * Currency
 */
class Currency extends CurrencyAbstract implements CurrencyInterface
{
    use CurrencyTrait;

    /**
     * @codeCoverageIgnore
     * @return array
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
}
