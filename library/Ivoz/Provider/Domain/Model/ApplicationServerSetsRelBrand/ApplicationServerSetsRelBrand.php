<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand;

/**
 * ApplicationServerSetsRelBrand
 */
class ApplicationServerSetsRelBrand extends ApplicationServerSetsRelBrandAbstract implements ApplicationServerSetsRelBrandInterface
{
    use ApplicationServerSetsRelBrandTrait;

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
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
