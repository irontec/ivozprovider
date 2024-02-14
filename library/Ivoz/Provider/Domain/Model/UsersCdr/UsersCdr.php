<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

/**
 * UsersCdr
 */
class UsersCdr extends UsersCdrAbstract implements UsersCdrInterface
{
    use UsersCdrTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

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
