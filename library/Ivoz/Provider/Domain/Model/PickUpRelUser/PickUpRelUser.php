<?php
namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

/**
 * PickUpRelUser
 */
class PickUpRelUser extends PickUpRelUserAbstract implements PickUpRelUserInterface
{
    use PickUpRelUserTrait;

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

