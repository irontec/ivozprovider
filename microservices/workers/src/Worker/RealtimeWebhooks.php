<?php

namespace Worker;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\WebhookJobInterface;
use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class RealtimeWebhooks
{
    private const REDIS_REALTIME_DB = 1;

    /** @var string[] */
    private const CHANNEL_PATTERNS = ['users:*', 'trunks:*'];

    /** @var array<string, string> Kamailio event -> webhook event */
    private const EVENT_MAP = [
        'Trying' => 'start',
        'Proceeding' => 'ring',
        'Early' => 'ring',
        'Confirmed' => 'answer',
        'Terminated' => 'end',
    ];

    /** @var array<string, int> webhook event -> ordinal para dedupe */
    private const STATE_ORDINAL = [
        'start' => 0,
        'ring' => 1,
        'answer' => 2,
        'end' => 3,
    ];

    /**
     * @var array<string, array{
     *     brandId: int,
     *     companyId: int,
     *     trunkCaller: ?string,
     *     trunkCallee: ?string,
     *     party: ?string,
     *     owner: ?string,
     *     direction: ?string,
     *     lastFiredState: int
     * }>
     */
    private array $callCache = [];

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private WebhookJobInterface $webhookJob,
        private LoggerInterface $logger,
    ) {
    }

    public function dispatch(): Response
    {
        $redis = $this->redisMasterFactory->create(self::REDIS_REALTIME_DB);

        $redis->pSubscribe(
            self::CHANNEL_PATTERNS,
            function ($redis, $pattern, $channel, $message): void {
                try {
                    $this->processMessage($channel, $message);
                } catch (\Throwable $e) {
                    $this->logger->error(
                        '[RT-WEBHOOK] Error processing message on ' . $channel . ': ' . $e->getMessage()
                    );
                }
            }
        );

        return new Response('', 500);
    }

    private function processMessage(string $channel, string $message): void
    {
        if (!preg_match('/^(users|trunks):b(\d+):c(\d+):/', $channel, $matches)) {
            return;
        }

        $source = $matches[1];
        $brandId = (int) $matches[2];
        $companyId = (int) $matches[3];

        /** @var array<string, mixed>|null $data */
        $data = json_decode($message, true);
        if (!is_array($data) || !isset($data['Event'])) {
            return;
        }

        $kamEvent = (string) $data['Event'];
        $callId = isset($data['Call-ID'])
            ? (string) $data['Call-ID']
            : null;

        if ($callId === null) {
            return;
        }

        if ($kamEvent === 'UpdateCLID') {
            return;
        }

        $webhookEvent = self::EVENT_MAP[$kamEvent] ?? null;
        if ($webhookEvent === null) {
            return;
        }

        $this->mergeCache($callId, $brandId, $companyId, $source, $data);

        $newStateOrdinal = self::STATE_ORDINAL[$webhookEvent];
        $entry = $this->callCache[$callId];

        if ($newStateOrdinal <= $entry['lastFiredState']) {
            return;
        }

        [$caller, $callee] = $this->resolveCallerCallee($entry);

        $payload = new WebhookEventPayload(
            event: $webhookEvent,
            brandId: $brandId,
            companyId: $companyId,
            ddiId: null,
            ddiE164: null,
            callId: $callId,
            uniqueId: isset($data['ID']) ? (string) $data['ID'] : null,
            caller: $caller,
            callee: $callee,
            dialStatus: null,
            timestamp: isset($data['Time'])
                ? date('Y-m-d\TH:i:s.v\Z', (int) $data['Time'])
                : null,
        );

        $this->webhookJob
            ->setData($payload)
            ->send();

        $this->callCache[$callId]['lastFiredState'] = $newStateOrdinal;

        if ($webhookEvent === 'end') {
            unset($this->callCache[$callId]);
        }
    }

    /**
     * @param array<string, mixed> $data
     */
    private function mergeCache(string $callId, int $brandId, int $companyId, string $source, array $data): void
    {
        $entry = $this->callCache[$callId] ?? [
                'brandId' => $brandId,
                'companyId' => $companyId,
                'trunkCaller' => null,
                'trunkCallee' => null,
                'party' => null,
                'owner' => null,
                'direction' => null,
                'lastFiredState' => -1,
            ];

        if ($source === 'trunks') {
            if (isset($data['Caller'])) {
                $entry['trunkCaller'] = (string) $data['Caller'];
            }
            if (isset($data['Callee'])) {
                $entry['trunkCallee'] = (string) $data['Callee'];
            }
            if (isset($data['Direction']) && $entry['direction'] === null) {
                $entry['direction'] = (string) $data['Direction'];
            }

        }

        if ($source === 'users') {
            if (isset($data['Party'])) {
                $entry['party'] = (string)$data['Party'];
            }
            if (isset($data['Owner'])) {
                $entry['owner'] = (string)$data['Owner'];
            }
            if (isset($data['Direction'])) {
                $entry['direction'] = (string)$data['Direction'];
            }
        }

        $this->callCache[$callId] = $entry;
    }

    /**
     *
     * @param array{
     *     brandId: int,
     *     companyId: int,
     *     trunkCaller: ?string,
     *     trunkCallee: ?string,
     *     party: ?string,
     *     owner: ?string,
     *     direction: ?string,
     *     lastFiredState: int
     * } $entry
     * @return array{0: ?string, 1: ?string}
     */
    private function resolveCallerCallee(array $entry): array
    {
        if ($entry['trunkCaller'] !== null || $entry['trunkCallee'] !== null) {
            return [$entry['trunkCaller'], $entry['trunkCallee']];
        }

        $party = $entry['party'];
        $owner = $entry['owner'];
        $direction = $entry['direction'];

        if ($direction === 'inbound') {
            return [$party, $owner];
        }

        return [$owner, $party];
    }
}
