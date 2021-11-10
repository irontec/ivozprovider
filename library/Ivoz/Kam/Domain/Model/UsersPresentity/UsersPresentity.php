<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

/**
 * UsersPresentity
 */
class UsersPresentity extends UsersPresentityAbstract implements UsersPresentityInterface
{
    use UsersPresentityTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
