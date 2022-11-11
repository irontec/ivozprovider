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
     */
    public function getId(): ?string
    {
        return $this->id;
    }
}
