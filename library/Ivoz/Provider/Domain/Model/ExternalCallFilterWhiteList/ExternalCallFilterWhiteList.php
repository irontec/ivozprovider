<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

/**
 * ExternalCallFilterWhiteList
 */
class ExternalCallFilterWhiteList extends ExternalCallFilterWhiteListAbstract implements ExternalCallFilterWhiteListInterface
{
    use ExternalCallFilterWhiteListTrait;

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

