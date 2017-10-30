<?php

namespace Ivoz\Provider\Domain\Model\GenericCallAclPattern;

/**
 * GenericCallAclPattern
 */
class GenericCallAclPattern extends GenericCallAclPatternAbstract implements GenericCallAclPatternInterface
{
    use GenericCallAclPatternTrait;

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

