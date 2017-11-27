<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

/**
 * TrunksDomainAttr
 */
class TrunksDomainAttr extends TrunksDomainAttrAbstract implements TrunksDomainAttrInterface
{
    use TrunksDomainAttrTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
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

