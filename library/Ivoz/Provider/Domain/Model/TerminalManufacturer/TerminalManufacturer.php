<?php

namespace Ivoz\Provider\Domain\Model\TerminalManufacturer;

/**
 * TerminalManufacturer
 */
class TerminalManufacturer extends TerminalManufacturerAbstract implements TerminalManufacturerInterface
{
    use TerminalManufacturerTrait;

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
