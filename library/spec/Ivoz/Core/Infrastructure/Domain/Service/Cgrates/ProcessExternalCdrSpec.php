<?php

namespace spec\Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Infrastructure\Persistence\Doctrine\TpCdrDoctrineRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ProcessExternalCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use Prophecy\Prophet;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ApiClient;

class ProcessExternalCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var TpCdrRepository
     */
    protected $tpCdrRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function let(
        ApiClient $apiClient,
        EntityTools $entityTools,
        TpCdrRepository $tpCdrRepository,
        LoggerInterface $logger
    ) {
        $this->apiClient = $apiClient;
        $this->entityTools = $entityTools;
        $this->tpCdrRepository = $tpCdrRepository;
        $this->logger = $logger;

        $this->beConstructedWith(
            $apiClient,
            $entityTools,
            $tpCdrRepository,
            $logger
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

    function it_does_nothing_with_externallyRated_carrier(
        TrunksCdrInterface $trunksCdr,
        CarrierInterface $carrier
    ) {
        $trunksCdr
            ->getCarrier()
            ->willReturn($carrier)
            ->shouldBeCalled();

        $carrier
            ->getExternallyRated()
            ->willReturn(true);

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
            ->getId()
            ->willReturn(1);

        $company
            ->getId()
            ->willReturn(1);

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
            ->getId()
            ->willReturn(2);

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
            $trunksCdr,
            [
                'getId' => 1,
                'getBrand' => $brand,
                'getCompany' => $company,
                'getCarrier' => null,
                'getCallid' => '',
                'getCallee' => '',
                'getDuration' => '',
                'getStartTime' => $startTime
            ],
            false
        );

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
