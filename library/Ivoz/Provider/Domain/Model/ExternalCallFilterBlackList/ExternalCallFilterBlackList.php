<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

/**
 * ExternalCallFilterBlackList
 */
class ExternalCallFilterBlackList extends ExternalCallFilterBlackListAbstract implements ExternalCallFilterBlackListInterface
{
    use ExternalCallFilterBlackListTrait;

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

