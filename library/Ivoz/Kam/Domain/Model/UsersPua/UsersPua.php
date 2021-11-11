<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

/**
 * UsersPua
 */
class UsersPua extends UsersPuaAbstract implements UsersPuaInterface
{
    use UsersPuaTrait;

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
