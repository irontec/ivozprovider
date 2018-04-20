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
     * @throws \DomainException
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

        return $this->sendRequest(
            $payload
        );
    }

    /**
     * Simulate call and get billing details
     *
     * @param string $tenant
     * @param string $subject
     * @param int $durationSeconds
     *
     * @throws \DomainException
     * @return SimulatedCall
     */
    public function simulateCallByRatingPlan(string $tenant, string $ratingPlan, string $destination, int $durationSeconds)
    {
        $answerDateTime = new \DateTime();
        $answerDateTime->setTimestamp(time());
        $answerDateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));

        $payload = [
            'Tenant' => $tenant,
            'RatingPlanId' => $ratingPlan,
            'Category' => 'call',
            'AnswerTime' => $answerDateTime->format('Y-m-d\TH:i:s\Z'),
            'Destination' => $destination,
            'Usage' => "${durationSeconds}s"
        ];

        return $this->sendRequest(
            $payload
        );
    }

    /**
     * @param $payload
     * @throws \DomainException
     * @return SimulatedCall
     */
    private function sendRequest(array $payload)
    {
        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $request */
        $request = $this->client
            ->request(
                1,
                'ApierV1.GetCost',
                [$payload]
            );

        $response = $this->client->send($request);
        $stringResponse = $response->getBody()->__toString();

        try {

            return SimulatedCall::fromCgRatesResponse(
                $stringResponse,
                substr($payload['Usage'], 0, -1),
                $this->entityTools
            );
        } catch (\RuntimeException $e) {

            return SimulatedCall::fromErrorResponse(
                $e->getMessage(),
                $payload['RatingPlanId'],
                $this->entityTools
            );
        }
    }
}