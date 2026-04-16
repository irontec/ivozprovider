<?php

namespace Ivoz\Provider\Domain\Model\Webhook\Payload;

use Ivoz\Core\Domain\Assert\Assertion;

class WebhookEventPayload
{
    public const VALID_KEYS = [
        'event',
        'brandId',
        'companyId',
        'ddiId',
        'ddiE164',
        'callId',
        'uniqueId',
        'caller',
        'callee',
        'dialStatus',
        'timestamp'
    ];

    public string $event;
    public int $brandId;
    public ?int $companyId;
    public ?int $ddiId;
    public ?string $ddiE164;
    public ?string $callId;
    public ?string $uniqueId;
    public ?string $caller;
    public ?string $callee;
    public ?string $dialStatus;
    public ?string $timestamp;

    public function __construct(
        string $event,
        int $brandId,
        ?int $companyId,
        ?int $ddiId,
        ?string $ddiE164,
        ?string $callId,
        ?string $uniqueId,
        ?string $caller,
        ?string $callee,
        ?string $dialStatus,
        ?string $timestamp,
    ) {
        $this->event = $event;
        $this->brandId = $brandId;
        $this->companyId = $companyId;
        $this->ddiId = $ddiId;
        $this->ddiE164 = $ddiE164;
        $this->callId = $callId;
        $this->uniqueId = $uniqueId;
        $this->caller = $caller;
        $this->callee = $callee;
        $this->dialStatus = $dialStatus;
        $this->timestamp = $timestamp;
    }

    public static function fromJson(string $jsonPayload): WebhookEventPayload
    {
        /** @var array<string, mixed> $rawPayload */
        $rawPayload = json_decode(
            $jsonPayload,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        Assertion::allChoice(
            array_keys($rawPayload),
            self::VALID_KEYS,
        );

        return new self(
            event: (string)$rawPayload['event'],
            brandId: (int)$rawPayload['brandId'],
            companyId: ((int)$rawPayload['companyId']) ?: null,
            ddiId: ((int)$rawPayload['ddiId']) ?: null,
            ddiE164: ((string)$rawPayload['ddiE164']) ?: null,
            callId: ((string)$rawPayload['callId']) ?: null,
            uniqueId: ((string)$rawPayload['uniqueId']) ?: null,
            caller: ((string)$rawPayload['caller']) ?: null,
            callee: ((string)$rawPayload['callee']) ?: null,
            dialStatus: ((string)$rawPayload['dialStatus']) ?: null,
            timestamp: ((string)$rawPayload['timestamp']) ?: null,
        );
    }
}
