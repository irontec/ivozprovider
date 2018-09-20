<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

/**
 * CompanyRelRoutingTag
 * @codeCoverageIgnore
 */
class CompanyRelRoutingTag extends CompanyRelRoutingTagAbstract implements CompanyRelRoutingTagInterface
{
    use CompanyRelRoutingTagTrait;

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
