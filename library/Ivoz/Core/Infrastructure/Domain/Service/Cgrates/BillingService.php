<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\Client;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\BillingServiceInterface;
use Ivoz\Core\Application\Service\EntityTools;

class BillingService implements BillingServiceInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        Client $client,
        EntityTools $entityTools
    ) {
        $this->client = $client;

        $this->entityTools = $entityTools;
    }

    /**
     * Simulate call and get billing details
     *
     * @param string $tenant
     * @param string $subject
     * @param int $durationSeconds
     *
     * @return SimulatedCall
     */
    public function simulateCall(string $tenant, string $subject, string $destination, int $durationSeconds)
    {
        $answerDateTime = new \DateTime();
        $answerDateTime->setTimestamp(time());
        $answerDateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));

        $payload = [
            'Tenant' => $tenant,
            'Subject' => $subject,
            'Category' => 'call',
            'AnswerTime' => $answerDateTime->format('Y-m-d\TH:i:s\Z'),
            'Destination' => $destination,
            'Usage' => "${durationSeconds}s"
        ];

        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $request */
        $request = $this->client
            ->request(
                1,
                'ApierV1.GetCost',
                [$payload]
            );

        $response = $this->client->send($request);

        return $this->normalizeResponse(
            $response->getBody()->__toString()
        );
    }

    private function normalizeResponse(string $response)
    {
        return SimulatedCall::fromCgRatesResponse(
            $response,
            $this->entityTools
        );
    }
}