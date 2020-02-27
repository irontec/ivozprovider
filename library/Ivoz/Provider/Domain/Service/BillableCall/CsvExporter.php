<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CsvExporter
{
    const API_ENDPOINT = 'billable_calls';

    const CLIENT_PROPERTIES = [
        'callid',
        'startTime',
        'direction',
        'caller',
        'callee',
        'duration',
        'price',
    ];

    const BRAND_PROPERTIES = [
        'callid',
        'startTime',
        'direction',
        'caller',
        'callee',
        'duration',
        'price',
        'endpointType',
        'endpointId',
        'company',
        'cost',
        'carrier',
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
     * @param string | null $direction
     * @return string
     */
    public function execute(
        \DateTime $inDate,
        \DateTime $outDate,
        CompanyInterface $company = null,
        BrandInterface $brand = null,
        $direction = BillableCallInterface::DIRECTION_OUTBOUND
    ) {
        $timezone = 'UTC';
        if ($company) {
            $timezone = $company->getDefaultTimezone()->getTz();
        } elseif ($brand) {
            $timezone = $brand->getDefaultTimezone()->getTz();
        }
        $dateTimeZone = new \DateTimeZone($timezone);

        $inDate->setTimezone($dateTimeZone);
        $outDate->setTimezone($dateTimeZone);

        $criteria = [
            'startTime[after]' => $inDate->format('Y-m-d H:i:s'),
            'startTime[strictly_before]' => $outDate->format('Y-m-d H:i:s'),
            "_pagination" => 'false'
        ];

        if (!empty($direction)) {
            $criteria['direction'] = $direction;
        }

        if ($company) {
            $criteria['company'] = $company->getId();
            $criteria['_properties'] = self::CLIENT_PROPERTIES;
            $criteria['_timezone'] = $company->getDefaultTimezone()->getTz();
        }

        if ($brand) {
            $criteria['brand'] = $brand->getId();
            $criteria['_properties'] = self::BRAND_PROPERTIES;
            $criteria['_timezone'] = $brand->getDefaultTimezone()->getTz();
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
