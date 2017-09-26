<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

/**
 * FriendsPattern
 */
class FriendsPattern extends FriendsPatternAbstract implements FriendsPatternInterface
{
    use FriendsPatternTrait;
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

