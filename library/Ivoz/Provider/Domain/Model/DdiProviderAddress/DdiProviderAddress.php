<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Assert\Assertion;

/**
 * DdiProviderAddress
 */
class DdiProviderAddress extends DdiProviderAddressAbstract implements DdiProviderAddressInterface
{
    use DdiProviderAddressTrait;

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

    /**
     * @inheritdoc
     */
    public function setIp(?string $ip = null): static
    {
        Assertion::ip($ip);

        return parent::setIp($ip);
    }
}
