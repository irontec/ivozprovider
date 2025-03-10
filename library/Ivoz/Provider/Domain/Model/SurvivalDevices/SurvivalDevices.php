<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevices;

/**
 * SurvivalDevices
 */
class SurvivalDevices extends SurvivalDevicesAbstract implements SurvivalDevicesInterface
{
    use SurvivalDevicesTrait;

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
