<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

/**
 * TrunksAddress
 */
class TrunksAddress extends TrunksAddressAbstract implements TrunksAddressInterface
{
    use TrunksAddressTrait;

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
