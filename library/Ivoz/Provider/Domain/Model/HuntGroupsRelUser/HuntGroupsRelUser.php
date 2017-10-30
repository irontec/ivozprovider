<?php
namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

/**
 * HuntGroupsRelUser
 */
class HuntGroupsRelUser extends HuntGroupsRelUserAbstract implements HuntGroupsRelUserInterface
{
    use HuntGroupsRelUserTrait;

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

