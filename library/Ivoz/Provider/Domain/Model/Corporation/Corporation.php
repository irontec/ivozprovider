<?php

namespace Ivoz\Provider\Domain\Model\Corporation;

/**
 * Corporation
 */
class Corporation extends CorporationAbstract implements CorporationInterface
{
    use CorporationTrait;

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
    public function getId(): int|string|null
    {
        return $this->id;
    }
}
