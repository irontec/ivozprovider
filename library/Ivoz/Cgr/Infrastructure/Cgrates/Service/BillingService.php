<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Service\RatingProfile\BillingServiceInterface;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;

class BillingService implements BillingServiceInterface
{
    public function __construct(
        private ClientInterface $client,
        private EntityTools $entityTools
    ) {
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
    public function simulateCall(string $tenant, string $subject, string $destination, int $durationSeconds): SimulatedCall
    {
        $answerDateTime = new \DateTime();
        $answerDateTime->setTimestamp(time());
        $answerDateTime->setTimezone(new \DateTimeZone('UTC'));

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
     */
    public function simulateCallByRatingPlan(string $tenant, string $ratingPlanTag, string $destination, int $durationSeconds): SimulatedCall
    {
        $answerDateTime = new \DateTime();
        $answerDateTime->setTimestamp(time());
        $answerDateTime->setTimezone(new \DateTimeZone('UTC'));

        $payload = [
            'Tenant' => $tenant,
            'RatingPlanId' => $ratingPlanTag,
            'Category' => 'call',
            'AnswerTime' => $answerDateTime->format('Y-m-d\TH:i:s\Z'),
            'Destination' => $destination,
            'Usage' => "${durationSeconds}s"
        ];

        try {
            return $this->sendRequest(
                $payload
            );
        } catch (\RuntimeException $e) {
            return SimulatedCall::fromErrorResponse(
                $e->getMessage(),
                $payload['RatingPlanId'],
                $this->entityTools
            );
        }
    }

    /**
     * @param array $payload
     * @throws \DomainException
     * @return SimulatedCall
     */
    private function sendRequest(array $payload): SimulatedCall
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

        return SimulatedCall::fromCgRatesResponse(
            $stringResponse,
            (int) substr($payload['Usage'], 0, -1),
            $this->entityTools
        );
    }
}
