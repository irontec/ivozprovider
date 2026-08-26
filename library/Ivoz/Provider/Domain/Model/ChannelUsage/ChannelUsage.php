<?php

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

/**
 * ChannelUsage
 */
class ChannelUsage extends ChannelUsageAbstract implements ChannelUsageInterface
{
    use ChannelUsageTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
