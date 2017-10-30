<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelPattern;

/**
 * CallAclRelPattern
 */
class CallAclRelPattern extends CallAclRelPatternAbstract implements CallAclRelPatternInterface
{
    use CallAclRelPatternTrait;

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

