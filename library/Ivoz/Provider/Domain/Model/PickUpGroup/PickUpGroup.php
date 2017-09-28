<?php
namespace Ivoz\Provider\Domain\Model\PickUpGroup;

/**
 * PickUpGroup
 */
class PickUpGroup extends PickUpGroupAbstract implements PickUpGroupInterface
{
    use PickUpGroupTrait;

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

