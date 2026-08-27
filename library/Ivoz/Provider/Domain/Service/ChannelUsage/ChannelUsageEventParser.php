<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;
use Psr\Log\LoggerInterface;

/**
 * Turns raw queue entries into events, reporting what could not be read.
 *
 * The wire format itself belongs to ChannelUsageEvent::fromWire(); this only decides what
 * to do with the entries it rejects.
 */
class ChannelUsageEventParser
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param array<int, string> $rawEntries
     * @return array<int, ChannelUsageEvent>
     */
    public function parse(array $rawEntries): array
    {
        $events = [];
        $discarded = 0;

        foreach ($rawEntries as $rawEntry) {
            $event = ChannelUsageEvent::fromWire($rawEntry);

            if ($event === null) {
                $discarded++;
                continue;
            }

            $events[] = $event;
        }

        if ($discarded > 0) {
            $this->logger->warning(
                sprintf(
                    'ChannelUsage: discarded %d malformed event(s) from the queue.',
                    $discarded
                )
            );
        }

        return $events;
    }
}
