<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

/**
 * CallAclRelPattern
 */
class CallAclRelMatchList extends CallAclRelMatchListAbstract implements CallAclRelMatchListInterface
{
    use CallAclRelMatchListTrait;

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

