<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CsvExporter
{
    const API_ENDPOINT = 'billable_calls';

    protected $apiClient;

    public function __construct(
        ApiClientInterface $apiClient
    ) {
        $this->apiClient = $apiClient;
    }

    /**
     * @param CompanyInterface $company
     * @param \DateTime $inDate
     * @param \DateTime $outDate
     * @return string
     */
    public function execute(
        CompanyInterface $company,
        \DateTime $inDate,
        \DateTime $outDate
    ) {
        $criteria = [
            'company' => $company->getId(),
            'startTime[after]' => $inDate->format('Y-m-d H:i:s'),
            'startTime[strictly_before]' => $outDate->format('Y-m-d H:i:s'),
            '_properties' => [
                'startTime',
                'caller',
                'callee',
                'duration' => 'duration',
                'price' => 'price'
            ],
            "_pagination" => 'false'
        ];

        $endpoint =
            self::API_ENDPOINT
            . '?'
            . http_build_query($criteria);

        $options = [
            'headers' => [
                'Accept' => 'text/csv'
            ]
        ];

        $response = $this->apiClient->get(
            $endpoint,
            $options
        );

        return $response->getBody()->__toString();
    }
}
