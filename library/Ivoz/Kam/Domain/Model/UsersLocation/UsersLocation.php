<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

/**
 * UsersLocation
 */
class UsersLocation extends UsersLocationAbstract implements UsersLocationInterface
{
    use UsersLocationTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
