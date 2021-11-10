<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

class UsersXcap extends UsersXcapAbstract implements UsersXcapInterface
{
    use UsersXcapTrait;

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
