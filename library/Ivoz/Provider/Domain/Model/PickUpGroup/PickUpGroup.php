<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

/**
 * PickUpGroup
 */
class PickUpGroup extends PickUpGroupAbstract implements PickUpGroupInterface
{
    use PickUpGroupTrait;

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
