<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CsvExporter
{
    const API_ENDPOINT = 'billable_calls';

    const CLIENT_PROPERTIES = [
        'callid',
        'startTime',
        'caller',
        'callee',
        'duration',
        'price'
    ];

    const BRAND_PROPERTIES = [
        'callid',
        'startTime',
        'caller',
        'callee',
        'duration',
        'price',
        'endpointType',
        'endpointId',
        'company',
        'cost',
        'carrierName',
        'ratingPlanName',
        'destinationName'
    ];

    protected $apiClient;

    public function __construct(
        ApiClientInterface $apiClient
    ) {
        $this->apiClient = $apiClient;
    }

    /**
     * @param \DateTime $inDate
     * @param \DateTime $outDate
     * @param CompanyInterface|null $company
     * @param BrandInterface|null $brand
     * @return string
     */
    public function execute(
        \DateTime $inDate,
        \DateTime $outDate,
        CompanyInterface $company = null,
        BrandInterface $brand = null
    ) {
        $criteria = [
            'startTime[after]' => $inDate->format('Y-m-d H:i:s'),
            'startTime[strictly_before]' => $outDate->format('Y-m-d H:i:s'),
            "_pagination" => 'false'
        ];

        if ($company) {
            $criteria['company'] = $company->getId();
            $criteria['_properties'] = self::CLIENT_PROPERTIES;
        }

        if ($brand) {
            $criteria['brand'] = $brand->getId();
            $criteria['_properties'] = self::BRAND_PROPERTIES;
        }

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
