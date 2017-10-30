<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

/**
 * Changelog
 */
class Changelog extends ChangelogAbstract implements ChangelogInterface
{
    use ChangelogTrait;

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

