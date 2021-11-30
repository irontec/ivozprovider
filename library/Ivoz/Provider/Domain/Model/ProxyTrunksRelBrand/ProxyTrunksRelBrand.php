<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

/**
 * ProxyTrunksRelBrand
 */
class ProxyTrunksRelBrand extends ProxyTrunksRelBrandAbstract implements ProxyTrunksRelBrandInterface
{
    use ProxyTrunksRelBrandTrait;

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
