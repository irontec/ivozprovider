<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

/**
 * UsersPresentity
 */
class UsersPresentity extends UsersPresentityAbstract implements UsersPresentityInterface
{
    use UsersPresentityTrait;

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
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
