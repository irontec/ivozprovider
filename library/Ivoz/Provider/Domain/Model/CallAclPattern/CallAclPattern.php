<?php

namespace Ivoz\Provider\Domain\Model\CallAclPattern;

/**
 * CallAclPattern
 */
class CallAclPattern extends CallAclPatternAbstract implements CallAclPatternInterface
{
    use CallAclPatternTrait;

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

