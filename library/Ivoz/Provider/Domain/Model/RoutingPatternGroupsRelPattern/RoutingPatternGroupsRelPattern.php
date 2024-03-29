<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

/**
 * RoutingPatternGroupsRelPattern
 */
class RoutingPatternGroupsRelPattern extends RoutingPatternGroupsRelPatternAbstract implements RoutingPatternGroupsRelPatternInterface
{
    use RoutingPatternGroupsRelPatternTrait;

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
