<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

/**
 * A single channel usage event as published by kamtrunks.
 *
 * The wire format is:
 *
 *   A:<ts>:<brandId>:<companyId>:<occupancy>      a channel was admitted
 *   H:<ts>:<brandId>:<companyId>                  a counted channel was released
 *   B:<ts>:<brandId>:<companyId>:<brand|company>  a call was rejected by a limit
 *
 * The original wire string is kept: the parser drops malformed entries, so consumers
 * cannot infer how many raw queue entries a set of events came from and need the
 * originals to put back what they are not ready to process.
 */
final class ChannelUsageEvent
{
    public const TYPE_ADMITTED = 'A';
    public const TYPE_HANGUP = 'H';
    public const TYPE_BLOCKED = 'B';

    public const REASON_BRAND = 'brand';
    public const REASON_COMPANY = 'company';

    private const TYPES = [
        self::TYPE_ADMITTED,
        self::TYPE_HANGUP,
        self::TYPE_BLOCKED
    ];

    private function __construct(
        private string $type,
        private int $timestamp,
        private int $brandId,
        private int $companyId,
        private ?int $occupancy,
        private string $reason,
        private string $wire
    ) {
    }

    /**
     * @return self|null null when the entry does not hold a usable event
     */
    public static function fromWire(string $wire): ?self
    {
        $parts = explode(':', $wire);

        if (count($parts) < 4) {
            return null;
        }

        $type = $parts[0];
        $timestamp = (int) $parts[1];
        $brandId = (int) $parts[2];
        $companyId = (int) $parts[3];

        $isValid =
            in_array($type, self::TYPES, true)
            && $timestamp > 0
            && $brandId > 0
            && $companyId > 0;

        if (!$isValid) {
            return null;
        }

        $occupancy = null;
        if ($type === self::TYPE_ADMITTED && isset($parts[4])) {
            $occupancy = (int) $parts[4];
        }

        $reason = '';
        if ($type === self::TYPE_BLOCKED && isset($parts[4])) {
            $reason = $parts[4];
        }

        return new self(
            $type,
            $timestamp,
            $brandId,
            $companyId,
            $occupancy,
            $reason,
            $wire
        );
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * Occupancy reported by kamailio for an admission, when it shipped one.
     */
    public function getOccupancy(): ?int
    {
        return $this->occupancy;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getWire(): string
    {
        return $this->wire;
    }

    public function isAdmission(): bool
    {
        return $this->type === self::TYPE_ADMITTED;
    }

    public function isHangup(): bool
    {
        return $this->type === self::TYPE_HANGUP;
    }

    public function isBlock(): bool
    {
        return $this->type === self::TYPE_BLOCKED;
    }

    public function isBlockedByBrand(): bool
    {
        return $this->isBlock()
            && $this->reason === self::REASON_BRAND;
    }

    public function belongsTo(int $companyId): bool
    {
        return $this->companyId === $companyId;
    }

    public function happenedBefore(int $timestamp): bool
    {
        return $this->timestamp < $timestamp;
    }
}
