<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Graze\GuzzleHttp\JsonRpc\Client;
use GuzzleHttp\Exception\RequestException;
use Ivoz\Core\Domain\Model\EntityInterface;

abstract class AbstractBalanceService
{
    const TENANT_PREFIX = 'b';

    /**
     * @var Client
     */
    protected $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    /**
     * @param EntityInterface $entity
     * @return string
     */
    abstract protected function getTenant(EntityInterface $entity);

    /**
     * @param EntityInterface $entity
     * @return string
     */
    abstract protected function getAccount(EntityInterface $entity);

    /**
     * @param EntityInterface $entity
     * @param float $amount
     * @return array
     */
    protected function addBalance(EntityInterface $entity, float $amount)
    {
        $payload = $this->getBalancePayload($entity, $amount);

        return $this->sendRequest(
            'ApierV1.AddBalance',
            $payload
        );
    }

    /**
     * @param EntityInterface $entity
     * @param float $amount
     * @return array
     */
    protected function debitBalance(EntityInterface $entity, float $amount)
    {
        $payload = $this->getBalancePayload($entity, $amount);

        return $this->sendRequest(
            'ApierV1.DebitBalance',
            $payload
        );
    }

    /**
     * @param $brandId
     * @param array $ids
     * @return array|mixed
     */
    protected function getAccountsBalances(string $tenant, array $accountIds)
    {
        $payload = [
            'Tenant' => $tenant,
            'AccountIds' => $accountIds
        ];

        $requestId = 1;
        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $request */
        $request = $this->client
            ->request(
                $requestId,
                'ApierV2.GetAccounts',
                [$payload]
            );

        try {
            $response = $this->client->send($request);
        } catch (RequestException $e) {
            throw new \DomainException(
                "Unable to get information from Billing engine",
                40003,
                $e
            );
        }


        $payload = json_decode($response->getBody()->__toString());

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->balanceReducer($balance);
        }
        $payload->result = $balanceSum;

        return $payload;
    }

    private function sendRequest($method, $payload)
    {
        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $request */
        $request = $this->client
            ->request(
                1,
                $method,
                [$payload]
            );

        $response = $this->client->send($request);
        $responseObject = json_decode(
            $response->getBody()->__toString()
        );

        return [
            'success' => ($responseObject->result === 'OK'),
            'error' => $responseObject->error
        ];
    }

    private function getBalancePayload(EntityInterface $entity, $amount)
    {
        return [
            'Tenant' => $this->getTenant($entity),
            'Account' => $this->getAccount($entity),
            'BalanceUuid' => null,
            'BalanceId' => '*default',
            'BalanceType' => '*monetary',
            'Directions' => null,
            'Value' => $amount,
            'ExpiryTime' => null,
            'RatingSubject' => null,
            'Categories' => null,
            'DestinationIds' => null,
            'TimingIds' => null,
            'Weight' => null,
            'SharedGroups' => null,
            'Overwrite' => false,
            'Blocker' => null,
            'Disabled' => null
        ];
    }

    /**
     * @param \stdClass $item
     * @return array
     */
    private function balanceReducer($item)
    {
        $idNumericSegments = preg_split('/[^0-9]+/', $item->ID);
        $id = end($idNumericSegments);
        $balance =  $item->BalanceMap ?
            $item->BalanceMap->{'*monetary'}[0]->Value
            : 0;

        return [
            $id => $balance
        ];
    }
}
