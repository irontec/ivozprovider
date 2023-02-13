<?php

namespace spec\Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ProcessExternalCdr;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ApiClient;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class ProcessExternalCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $apiClient;
    protected $entityTools;
    protected $tpCdrRepository;
    protected $logger;
    protected $trunksClient;

    public function let(
        ApiClient $apiClient,
        EntityTools $entityTools,
        TpCdrRepository $tpCdrRepository,
        LoggerInterface $logger,
        TrunksClientInterface $trunksClient
    ) {
        $this->apiClient = $apiClient;
        $this->entityTools = $entityTools;
        $this->tpCdrRepository = $tpCdrRepository;
        $this->logger = $logger;
        $this->trunksClient = $trunksClient;

        $this->beConstructedWith(
            $apiClient,
            $entityTools,
            $tpCdrRepository,
            $logger,
            $trunksClient
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProcessExternalCdr::class);
    }

    function it_calls_cgrates_api(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        CompanyInterface $company,
        TpCdrInterface $tpCdr
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $company,
            $tpCdr
        );

        $this
            ->apiClient
            ->sendRequest(
                'CdrsV1.ProcessExternalCDR',
                Argument::any()
            )
            ->shouldBeCalled();

        $this->execute($trunksCdr);
    }

    function it_does_nothing_with_companies_without_billing_method(
        TrunksCdrInterface $trunksCdr,
        CompanyInterface $company
    ) {
        $trunksCdr
            ->isOutboundCall()
            ->willReturn(true)
            ->shouldBeCalled();

        $trunksCdr
            ->getCompany()
            ->willReturn($company)
            ->shouldBeCalled();

        $company
            ->getBillingMethod()
            ->willReturn(
                CompanyInterface::BILLINGMETHOD_NONE
            );

        $this
            ->execute($trunksCdr)
            ->shouldReturn(false);
    }

    function it_returns_true_when_external_CDR_processing_is_succeeded(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        CompanyInterface $company,
        TpCdrInterface $tpCdr
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $company,
            $tpCdr
        );

        $this
            ->execute($trunksCdr)
            ->shouldReturn(true);
    }

    function it_constructs_api_payload(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        CompanyInterface $company,
        TpCdrInterface $tpCdr
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $company,
            $tpCdr
        );

        $trunksCdr
            ->getCallid()
            ->willReturn('4567');

        $trunksCdr
            ->getCallee()
            ->willReturn('+346002050');

        $trunksCdr
            ->getStartTime()
            ->willReturn(
                new \DateTime(
                    '2019-01-15 12:00:00',
                    new \DateTimeZone('UTC')
                )
            );

        $trunksCdr
            ->getDuration()
            ->willReturn(4.26);

        $brand
            ->getCgrTenant()
            ->willReturn('b1');

        $company
            ->getCgrSubject()
            ->willReturn('c1');

        $company
            ->getBillingMethod()
            ->willReturn('prepaid');

        $expectedArgument = [
            'OriginHost' => '127.0.0.1',
            'Source' => 'offline',
            'OriginID' => '4567',
            'ToR' => '*voice',
            'RequestType' => '*prepaid',
            'Tenant' => 'b1',
            'Account' => 'c1',
            'Destination' => '+346002050',
            'SetupTime' => '2019-01-15T12:00:00Z',
            'AnswerTime' => '2019-01-15T12:00:00Z',
            'Usage' => '4s'
        ];

        $this
            ->apiClient
            ->sendRequest(
                'CdrsV1.ProcessExternalCDR',
                Argument::exact($expectedArgument)
            )
            ->shouldBeCalled();

        $this
            ->execute($trunksCdr);
    }

    function it_sets_payload_extra_fields_if_carrier_is_not_null(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        CompanyInterface $company,
        TpCdrInterface $tpCdr,
        CarrierInterface $carrier
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $company,
            $tpCdr
        );

        $trunksCdr
            ->getCarrier()
            ->willReturn($carrier)
            ->shouldBeCalled();

        $carrier
            ->getExternallyRated()
            ->willReturn(false);


        $carrier
            ->getCalculateCost()
            ->willReturn(true);

        $carrier
            ->getCgrSubject()
            ->willReturn('cr2');

        $this
            ->apiClient
            ->sendRequest(
                'CdrsV1.ProcessExternalCDR',
                Argument::that(function ($payload) {
                    return array_key_exists('ExtraFields', $payload);
                })
            )
            ->shouldBeCalled();

        $this
            ->execute($trunksCdr);
    }

    function it_logs_exceptions(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        CompanyInterface $company
    ) {
        $this->prepareExecution(
            $trunksCdr,
            $brand,
            $company
        );

        $this
            ->apiClient
            ->sendRequest(
                'CdrsV1.ProcessExternalCDR',
                Argument::any()
            )
            ->willThrow(\DomainException::class);

        $this
            ->logger
            ->error(Argument::type('string'))
            ->shouldBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->duringExecute($trunksCdr);
    }

    protected function prepareExecution(
        TrunksCdrInterface $trunksCdr,
        BrandInterface $brand,
        CompanyInterface $company,
        TpCdrInterface $tpCdr = null
    ) {
        $startTime = new \DateTime(
            '2019-01-15 12:00:00',
            new \DateTimeZone('UTC')
        );

        $this->getterProphecy(
            $brand,
            [
                'getCgrTenant' => 'b1',
            ],
            false
        );

        $this->getterProphecy(
            $company,
            [
                'getCgrSubject' => 'c1',
                'getBillingMethod' => 'postpaid',
            ],
            false
        );

        $this->getterProphecy(
            $trunksCdr,
            [
                'getId' => 1,
                'getBrand' => $brand,
                'getCompany' => $company,
                'getCarrier' => null,
                'getCallid' => '',
                'getCallee' => '',
                'getDuration' => 10,
                'getStartTime' => $startTime,
                'isOutboundCall' => true
            ],
            false
        );

        $this->getterProphecy(
            $this->trunksClient,
            [
                'isCgrEnabled' => true
            ],
            false
        );

        if ($tpCdr) {
            $this->getterProphecy(
                $tpCdr,
                [
                    'getCgrid' => 'b10c1'
                ],
                false
            );
        }

        $this
            ->apiClient
            ->sendRequest(
                Argument::type('string'),
                Argument::type('array')
            )
            ->willReturn(null);

        $this
            ->tpCdrRepository
            ->getByOriginId(
                Argument::any()
            )
            ->willReturn($tpCdr);

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(TrunksCdrInterface::class)
            )
            ->willReturn(
                new TrunksCdrDto()
            );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TrunksCdrDto::class),
                Argument::type(TrunksCdrInterface::class),
                false
            )
            ->willReturn(null);
    }
}
