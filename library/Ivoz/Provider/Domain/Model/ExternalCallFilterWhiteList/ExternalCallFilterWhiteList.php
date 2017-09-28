<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

/**
 * ExternalCallFilterWhiteList
 */
class ExternalCallFilterWhiteList extends ExternalCallFilterWhiteListAbstract implements ExternalCallFilterWhiteListInterface
{
    use ExternalCallFilterWhiteListTrait;

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

