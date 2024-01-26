<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

use Ivoz\Core\Domain\Assert\Assertion;

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

    protected function setAdvertisedIp(?string $advertisedIp = null): static
    {
        if (!is_null($advertisedIp)) {
            Assertion::ip($advertisedIp);
        }

        return parent::setAdvertisedIp($advertisedIp);
    }
}
