<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

/**
 * FriendsPattern
 */
class FriendsPattern extends FriendsPatternAbstract implements FriendsPatternInterface
{
    use FriendsPatternTrait;

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

