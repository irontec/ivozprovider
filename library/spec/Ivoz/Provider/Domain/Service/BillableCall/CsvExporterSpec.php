<?php

namespace spec\Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\ApiClientInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
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
        CompanyInterface $company,
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $this->prepareConditions(
            $company,
            $response,
            $responseBody
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
            ->execute($company, $inDate, $outDate);
    }

    function it_adds_filter_arguments_into_the_url(
        CompanyInterface $company,
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $this->prepareConditions(
            $company,
            $response,
            $responseBody
        );

        $inDate = new \DateTime('2010-01-01 01:01:01');
        $outDate = new \DateTime('2015-01-01 01:01:01');

        $this
            ->apiClient
            ->get(
                $this->getEncodedUrl($company, $inDate, $outDate),
                Argument::any()
            )
            ->willReturn($response)
            ->shouldBeCalled();

        $this
            ->execute($company, $inDate, $outDate);
    }

    function it_request_csv_content_type(
        CompanyInterface $company,
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $this->prepareConditions(
            $company,
            $response,
            $responseBody
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
            ->execute($company, $inDate, $outDate);
    }

    protected function prepareConditions(
        CompanyInterface $company,
        ResponseInterface $response,
        StreamInterface $responseBody
    ) {
        $company
            ->getId()
            ->willReturn(1);

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
        CompanyInterface $company,
        \DateTime $inDate,
        \DateTime $outDate
    ) {
        $criteria = [
            'company' => $company->getWrappedObject()->getId(),
            'startTime[after]' => $inDate->format('Y-m-d H:i:s'),
            'startTime[strictly_before]' => $outDate->format('Y-m-d H:i:s'),
            '_properties' => CsvExporter::PROPERTIES,
            "_pagination" => 'false'
        ];

        return
            CsvExporter::API_ENDPOINT
            . '?'
            . http_build_query($criteria);
    }
}
