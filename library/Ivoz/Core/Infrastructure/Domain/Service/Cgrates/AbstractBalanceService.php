<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use GuzzleHttp\Exception\RequestException;
use Ivoz\Core\Domain\Model\EntityInterface;

abstract class AbstractBalanceService
{
    const TENANT_PREFIX = 'b';

    protected $client;

    const UNLIMITED_MAX_DAILY_USAGE = 1000000;

    public function __construct(
        CgrRpcClient $client
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
     * @param int $brandId
     * @param array $ids
     * @param string $accountPrefix
     * @return array|mixed
     */
    protected function getAccountsBalances(int $brandId, array $ids, string $accountPrefix)
    {
        $tenant = self::TENANT_PREFIX . $brandId;
        $accountIds = array_map(
            function ($companyId) use ($accountPrefix) {
                return $accountPrefix . $companyId;
            },
            $ids
        );

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

        return $payload;
    }

    /**
     * @return array
     * @psalm-return array{success:bool, error:mixed}
     */
    private function sendRequest($method, $payload): array
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

    /**
     * @return array
     *
     * @psalm-return array{Tenant:string, Account:string, BalanceUuid:null, BalanceId:string, BalanceType:string, Directions:null, Value:mixed, ExpiryTime:null, RatingSubject:null, Categories:null, DestinationIds:null, TimingIds:null, Weight:null, SharedGroups:null, Overwrite:false, Blocker:null, Disabled:null}
     */
    private function getBalancePayload(EntityInterface $entity, $amount): array
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
    protected function balanceReducer($item)
    {
        $idNumericSegments = preg_split('/[^0-9]+/', $item->ID);
        $id = end($idNumericSegments);
        $balance =  $item->BalanceMap
            ? $item->BalanceMap->{'*monetary'}[0]->Value
            : 0;

        return [
            $id => $balance
        ];
    }

    /**
     * @param \stdClass $item
     * @return array
     */
    protected function currentDayUsageReducer($item)
    {
        $idNumericSegments = preg_split('/[^0-9]+/', $item->ID);
        $id = end($idNumericSegments);

        $containsUnitCounter =
            isset($item->UnitCounters)
            && isset($item->UnitCounters->{'*monetary'});

        $balance = $containsUnitCounter
            ? $item->UnitCounters->{'*monetary'}[0]->Counters[0]->Value
            : -1;

        return [
            $id => $balance
        ];
    }

    /**
     * @param \stdClass $item
     * @return array
     */
    protected function currentDayMaxUsageReducer($item)
    {
        $idNumericSegments = preg_split('/[^0-9]+/', $item->ID);
        $id = end($idNumericSegments);
        $balance =  $item->ActionTriggers
            ? $item->ActionTriggers[0]->ThresholdValue
            : -1;

        if ($balance == self::UNLIMITED_MAX_DAILY_USAGE) {
            $balance = "∞";
        }

        return [
            $id => $balance
        ];
    }
    /**
     * @param \stdClass $item
     * @return array
     */
    protected function accountStatusReducer($item)
    {
        $idNumericSegments = preg_split('/[^0-9]+/', $item->ID);
        $id = end($idNumericSegments);

        return [
            $id => $item->Disabled
        ];
    }
}
