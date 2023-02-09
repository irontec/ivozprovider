<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

/**
 * UsersLocationAttr
 */
class UsersLocationAttr extends UsersLocationAttrAbstract implements UsersLocationAttrInterface
{
    use UsersLocationAttrTrait;

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
