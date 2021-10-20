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
    public function getId()
    {
        return $this->id;
    }
}
