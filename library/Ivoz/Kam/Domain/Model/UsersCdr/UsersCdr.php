<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

/**
 * UsersCdr
 */
class UsersCdr extends UsersCdrAbstract implements UsersCdrInterface
{
    use UsersCdrTrait;

    public const DIRECTION_OUTBOUND = "outbound";
    public const DIRECTION_INBOUND = "inbound";

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOwner(): ?string
    {
        if (!is_null($this->getUser())) {
            return $this->getUser()->getFullNameExtension();
        }
        if (!is_null($this->getFriend())) {
            return $this->getFriend()->getName();
        }

        if ($this->getDirection() === UsersCdr::DIRECTION_OUTBOUND) {
            return $this->getCaller();
        }
        return $this->getCallee();
    }

    /**
     * @return string
     */
    public function getParty(): ?string
    {
        if ($this->getDirection() === UsersCdr::DIRECTION_OUTBOUND) {
            return $this->getCallee();
        }
        return $this->getCaller();
    }
}
