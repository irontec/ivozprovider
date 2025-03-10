<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevice;

/**
 * SurvivalDevice
 */
class SurvivalDevice extends SurvivalDeviceAbstract implements SurvivalDeviceInterface
{
    use SurvivalDeviceTrait;

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
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
