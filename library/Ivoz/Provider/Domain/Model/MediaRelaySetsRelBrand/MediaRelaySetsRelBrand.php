<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand;

/**
 * MediaRelaySetsRelBrand
 */
class MediaRelaySetsRelBrand extends MediaRelaySetsRelBrandAbstract implements MediaRelaySetsRelBrandInterface
{
    use MediaRelaySetsRelBrandTrait;

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
