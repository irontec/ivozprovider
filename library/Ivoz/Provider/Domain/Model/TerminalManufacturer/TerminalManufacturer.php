<?php

namespace Ivoz\Provider\Domain\Model\TerminalManufacturer;

/**
 * TerminalManufacturer
 */
class TerminalManufacturer extends TerminalManufacturerAbstract implements TerminalManufacturerInterface
{
    use TerminalManufacturerTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

