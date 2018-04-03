<?php

namespace Ivoz\Core\Infrastructure\Service\Cgrates;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface;
use Graze\GuzzleHttp\JsonRpc\Client;

class JsonRcpClient implements CompanyBalanceServiceClientInterface
{
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
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::incrementBalance
     * @inheritdoc
     */
    public function incrementBalance(CompanyInterface $company, float $amount)
    {
        $payload = $this->getAddBalancePayload($company, $amount);

        /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $request */
        $request = $this->client
            ->request(
                1,
                'ApierV1.AddBalance',
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
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getBalances
     * @inheritdoc
     */
    public function getBalances($brandId, array $companyIds)
    {
        $tenant = 'b' . $brandId;
        $accountIds = array_map(
            function ($companyId) {
                return 'c' . $companyId;
            },
            $companyIds
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

        $response = $this->client->send($request);
        $payload = json_decode($response->getBody()->__toString());

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->balanceReducer($balance);
        }
        $payload->result = $balanceSum;

        return $payload;
    }


    public function getBalance($brandId, $companyId)
    {
        $companyIds = [$companyId];
        $payload = $this->getBalances($brandId, $companyIds);

        return $payload->result[$companyId];
    }


    private function getAddBalancePayload(CompanyInterface $company, $amount)
    {
        $brand = $company->getBrand();

        return [
            'Tenant' =>'b' . $brand->getId(),
            'Account' => 'c' . $company->getId(),
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
        $companyId = substr($item->ID, -1);
        $balance =  $item->BalanceMap->{'*monetary'}[0]->Value;

        return [
            $companyId => $balance
        ];
    }
}