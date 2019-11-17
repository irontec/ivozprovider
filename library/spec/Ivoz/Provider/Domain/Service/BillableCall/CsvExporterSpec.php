<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Service\BillableCall\CsvExporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CsvExporterSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $apiClient;

    public function let(
        ApiClientInterface $apiClient
    ) {
        $this->apiClient = $apiClient;

        $this->beConstructedWith(
            $this->apiClient
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvExporter::class);
    }

    function it_returns_string_response(
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $company = $this->getInstance(
            Company::class
        );

        $this->prepareConditions(
            $response,
            $responseBody,
            $company
        );

        $this
            ->apiClient
            ->get(
                Argument::any(),
                Argument::any()
            )->willReturn($response);

        $inDate = new \DateTime('2010-01-01 01:01:01');
        $outDate = new \DateTime('2015-01-01 01:01:01');

        $this
            ->execute($inDate, $outDate, $company);
    }

    function it_adds_filter_arguments_into_the_url(
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $company = $this->getInstance(
            Company::class
        );

        $this->prepareConditions(
            $response,
            $responseBody,
            $company
        );

        $inDate = new \DateTime('2010-01-01 01:01:01');
        $outDate = new \DateTime('2015-01-01 01:01:01');

        $this
            ->apiClient
            ->get(
                $this->getEncodedUrl($inDate, $outDate, $company),
                Argument::any()
            )
            ->willReturn($response)
            ->shouldBeCalled();

        $this
            ->execute($inDate, $outDate, $company);
    }

    function it_request_csv_content_type(
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $company = $this->getInstance(
            Company::class
        );

        $this->prepareConditions(
            $response,
            $responseBody,
            $company
        );

        $inDate = new \DateTime('2010-01-01 01:01:01');
        $outDate = new \DateTime('2015-01-01 01:01:01');

        $this
            ->apiClient
            ->get(
                Argument::any(),
                [
                    'headers' => [
                        'Accept' => 'text/csv'
                    ]
                ]
            )->willReturn($response);

        $this
            ->execute($inDate, $outDate, $company);
    }

    function company_is_nullable(
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $this->prepareConditions(
            $response,
            $responseBody
        );

        $inDate = new \DateTime('2010-01-01 01:01:01');
        $outDate = new \DateTime('2015-01-01 01:01:01');

        $this
            ->execute($inDate, $outDate);
    }

    function it_accepts_brand(
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $brand = $this->getInstance(
            Brand::class
        );

        $this->prepareConditions(
            $response,
            $responseBody,
            null,
            $brand
        );

        $inDate = new \DateTime('2010-01-01 01:01:01');
        $outDate = new \DateTime('2015-01-01 01:01:01');

        $this
            ->apiClient
            ->get(
                $this->getEncodedUrl($inDate, $outDate, null, $brand),
                Argument::any()
            )
            ->willReturn($response)
            ->shouldBeCalled();

        $this
            ->execute($inDate, $outDate, null, $brand);
    }

    protected function prepareConditions(
        ResponseInterface $response,
        StreamInterface $responseBody,
        CompanyInterface $company = null,
        BrandInterface $brand = null
    ) {

        $timezone = $this->getInstance(
            Timezone::class,
            [
                'tz' => 'UTC'
            ]
        );

        if ($company) {
            $this->updateInstance(
                $company,
                [
                    'id' => 1,
                    'defaultTimezone' => $timezone
                ]
            );
        } elseif ($brand) {
            $this->updateInstance(
                $brand,
                [
                    'id' => 1,
                    'defaultTimezone' => $timezone
                ]
            );
        }

        $responseBody
            ->__toString()
            ->willReturn('')
            ->shouldBeCalled();

        $response
            ->getBody()
            ->willReturn($responseBody)
            ->shouldBeCalled();
    }

    protected function getEncodedUrl(
        \DateTime $inDate,
        \DateTime $outDate,
        CompanyInterface $company = null,
        BrandInterface $brand = null,
        $direction = 'outbound'
    ) {
        $criteria = [
            'startTime[after]' => $inDate->format('Y-m-d H:i:s'),
            'startTime[strictly_before]' => $outDate->format('Y-m-d H:i:s'),
            "_pagination" => 'false',
            'direction' => $direction
        ];

        if ($company) {
            $criteria['company'] = $company->getId();
            $criteria['_properties'] = CsvExporter::CLIENT_PROPERTIES;
        }

        if ($brand) {
            $criteria['brand'] = $brand->getId();
            $criteria['_properties'] = CsvExporter::BRAND_PROPERTIES;
        }

        $criteria['_timezone'] = 'UTC';

        return
            CsvExporter::API_ENDPOINT
            . '?'
            . http_build_query($criteria);
    }
}
