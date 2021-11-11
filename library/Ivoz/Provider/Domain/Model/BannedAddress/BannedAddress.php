<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

/**
 * BannedAddress
 */
class BannedAddress extends BannedAddressAbstract implements BannedAddressInterface
{
    use BannedAddressTrait;

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
