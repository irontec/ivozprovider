<?php

namespace Ivoz\Provider\Domain\Model\Country;

/**
 * Country
 */
class Country extends CountryAbstract implements CountryInterface
{
    use CountryTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
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
