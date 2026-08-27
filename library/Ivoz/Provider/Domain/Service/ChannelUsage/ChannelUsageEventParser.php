<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\ChannelUsage;

use Psr\Log\LoggerInterface;

/**
 * Deserializes the wire format kamtrunks pushes to the channel usage queue.
 *
 *   A:<ts>:<brandId>:<companyId>:<occupancy>      a channel was admitted
 *   H:<ts>:<brandId>:<companyId>                  a counted channel was released
 *   B:<ts>:<brandId>:<companyId>:<brand|company>  a call was rejected by a limit
 */
class ChannelUsageEventParser
{
    public const TYPE_ADMITTED = 'A';
    public const TYPE_HANGUP = 'H';
    public const TYPE_BLOCKED = 'B';

    private const TYPES = [
        self::TYPE_ADMITTED,
        self::TYPE_HANGUP,
        self::TYPE_BLOCKED
    ];

    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    /**
     * Malformed entries are dropped, but the caller still consumed them: the returned
     * events carry no positional meaning, which is why queue trimming must always be
     * driven by the number of raw entries read and never by the number of events parsed.
     *
     * @param array<int, string> $rawEntries
     * @return array<int, array{type: string, ts: int, brandId: int, companyId: int, occ: int|null, reason: string, raw: string}>
     */
    public function parse(array $rawEntries): array
    {
        $events = [];
        $discarded = 0;

        foreach ($rawEntries as $rawEntry) {
            $event = $this->parseEntry($rawEntry);

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

    /**
     * @return array{type: string, ts: int, brandId: int, companyId: int, occ: int|null, reason: string, raw: string}|null
     */
    private function parseEntry(string $rawEntry): ?array
    {
        $parts = explode(':', $rawEntry);

        if (count($parts) < 4) {
            return null;
        }

        $type = $parts[0];
        $ts = (int) $parts[1];
        $brandId = (int) $parts[2];
        $companyId = (int) $parts[3];

        $isValid =
            in_array($type, self::TYPES, true)
            && $ts > 0
            && $brandId > 0
            && $companyId > 0;

        if (!$isValid) {
            return null;
        }

        $occ = null;
        if ($type === self::TYPE_ADMITTED && isset($parts[4])) {
            $occ = (int) $parts[4];
        }

        $reason = '';
        if ($type === self::TYPE_BLOCKED && isset($parts[4])) {
            $reason = $parts[4];
        }

        return [
            'type' => $type,
            'ts' => $ts,
            'brandId' => $brandId,
            'companyId' => $companyId,
            'occ' => $occ,
            'reason' => $reason,
            'raw' => $rawEntry
        ];
    }
}
