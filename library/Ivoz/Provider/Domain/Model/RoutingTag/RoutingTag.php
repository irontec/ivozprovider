<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

/**
 * RoutingTag
 */
class RoutingTag extends RoutingTagAbstract implements RoutingTagInterface
{
    use RoutingTagTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
