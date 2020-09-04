<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
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
        'ddi',
        'endpointType',
        'endpointId',
        'endpointName',
        'userId',
        'faxId',
        'friendId',
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
        'endpointName',
        'company',
        'cost',
        'carrier',
        'ddiProvider',
        'carrierName',
        'ratingPlanName',
        'destinationName',
        'ddi',
        'userId',
        'faxId',
        'friendId',
    ];

    protected $apiClient;

    public function __construct(
        ApiClientInterface $apiClient
    ) {
        $this->apiClient = $apiClient;
    }

    /**
     * @return string
     */
    public function execute(
        \DateTime $inDate,
        \DateTime $outDate,
        CompanyInterface $company = null,
        BrandInterface $brand = null,
        CallCsvSchedulerInterface $scheduler
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

        $direction = $scheduler->getCallDirection();
        if (!empty($direction)) {
            $criteria['direction'] = $direction;
        }

        $ddi = $scheduler->getDdi();
        if (!empty($ddi)) {
            $criteria['ddi'] = $ddi->getId();
        }

        $carrier = $scheduler->getCarrier();
        if (!empty($carrier)) {
            $criteria['carrier'] = $carrier->getId();
        }

        $ddiProvider = $scheduler->getDdiProvider();
        if (!empty($ddiProvider)) {
            $criteria['ddiProvider'] = $ddiProvider->getId();
        }

        $criteria = $this->addEndpointType(
            $scheduler,
            $criteria
        );

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

    private function addEndpointType(CallCsvSchedulerInterface $scheduler, array $criteria): array
    {
        $retailAccount = $scheduler->getRetailAccount();
        if (!empty($retailAccount)) {
            $criteria['endpointType'] = BillableCallInterface::ENDPOINTTYPE_RETAILACCOUNT;
            $criteria['endpointId'] = $retailAccount->getId();

            return $criteria;
        }

        $residentialDevice = $scheduler->getResidentialDevice();
        if (!empty($residentialDevice)) {
            $criteria['endpointType'] = BillableCallInterface::ENDPOINTTYPE_RESIDENTIALDEVICE;
            $criteria['endpointId'] = $residentialDevice->getId();

            return $criteria;
        }

        $user = $scheduler->getUser();
        if (!empty($user)) {
            $criteria['endpointType'] = BillableCallInterface::ENDPOINTTYPE_USER;
            $criteria['endpointId'] = $user->getId();

            return $criteria;
        }

        $fax = $scheduler->getFax();
        if (!empty($fax)) {
            $criteria['endpointType'] = BillableCallInterface::ENDPOINTTYPE_FAX;
            $criteria['endpointId'] = $fax->getId();

            return $criteria;
        }

        $friend = $scheduler->getFriend();
        if (!empty($friend)) {
            $criteria['endpointType'] = BillableCallInterface::ENDPOINTTYPE_FRIEND;
            $criteria['endpointId'] = $friend->getId();

            return $criteria;
        }

        return $criteria;
    }
}
