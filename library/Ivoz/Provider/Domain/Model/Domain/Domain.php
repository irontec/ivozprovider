<?php

namespace Ivoz\Provider\Domain\Model\Domain;

/**
 * Domain
 */
class Domain extends DomainAbstract implements DomainInterface
{
    use DomainTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

