<?php
namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

/**
 * UsersLocationAttr
 */
class UsersLocationAttr extends UsersLocationAttrAbstract implements UsersLocationAttrInterface
{
    use UsersLocationAttrTrait;

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

