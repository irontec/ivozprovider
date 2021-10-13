<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

/**
 * ExternalCallFilterBlackList
 */
class ExternalCallFilterBlackList extends ExternalCallFilterBlackListAbstract implements ExternalCallFilterBlackListInterface
{
    use ExternalCallFilterBlackListTrait;

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
