<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Assert\Assertion;

/**
 * RoutingPattern
 */
class RoutingPattern extends RoutingPatternAbstract implements RoutingPatternInterface
{
    use RoutingPatternTrait;

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

    /**
     * {@inheritDoc}
     */
    public function setPrefix(string $prefix = null): static
    {
        if (!empty($prefix)) {
            Assertion::regex($prefix, '/^\+[0-9]*/');
        }
        return parent::setPrefix($prefix);
    }
}
