<?php
namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

/**
 * UsersLocationAttr
 */
class UsersLocationAttr extends UsersLocationAttrAbstract implements UsersLocationAttrInterface
{
    use UsersLocationAttrTrait;

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

