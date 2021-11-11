<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

/**
 * ProxyUser
 */
class ProxyUser extends ProxyUserAbstract implements ProxyUserInterface
{
    use ProxyUserTrait;

    public const MAIN_ADDRESS_ID = 1;

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
