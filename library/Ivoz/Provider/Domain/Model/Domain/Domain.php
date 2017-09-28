<?php

namespace Ivoz\Provider\Domain\Model\Domain;

/**
 * Domain
 */
class Domain extends DomainAbstract implements DomainInterface
{
    use DomainTrait;

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

