<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

/**
 * RoutingTag
 */
class RoutingTag extends RoutingTagAbstract implements RoutingTagInterface
{
    use RoutingTagTrait;

    /**
     * @RoutingTagoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @RoutingTagoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}

