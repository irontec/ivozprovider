<?php

namespace Ivoz\Provider\Domain\Model\Domain;

/**
 * Domain
 */
class Domain extends DomainAbstract implements DomainInterface
{
    use DomainTrait;

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
