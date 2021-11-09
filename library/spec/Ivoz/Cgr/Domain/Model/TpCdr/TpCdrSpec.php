<?php

namespace spec\Ivoz\Cgr\Domain\Model\TpCdr;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdr;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class TpCdrSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    function let()
    {

        $utc = new \DateTimeZone('UTC');

        $this->dto = $dto = new TpCdrDto();
        $dto->setCgrid('3bfaa274e9926f37e5be6811b3874a2f30b36ee8');
        $dto->setRunId('*default');
        $dto->setOriginHost('127.0.0.1');
        $dto->setSource('KAMAILIO_CGR_CALL_END');
        $dto->setOriginId('1f24b985-0c8f-442e-b05d-745c870c7927;48ac4a2b-ebea-4aa9-90f2-5c79a721f562;failure_1548240521');
        $dto->setTor('*voice');
        $dto->setRequestType('*prepaid');
        $dto->setTenant('b1');
        $dto->setCategory('call');
        $dto->setAccount('c1');
        $dto->setSubject('c1');
        $dto->setDestination('+346003035');
        $dto->setSetupTime(
            new \DateTime('2019-01-23 11:48:36', $utc)
        );
        $dto->setAnswerTime(
            new \DateTime('2019-01-23 11:48:36', $utc)
        );
        $dto->setUsage(0);
        $dto->setExtraFields(
            '{"carrierId":"cr4","carrierReqtype":"*rated"}'
        );
        $dto->setCostSource('CDRS');
        $dto->setCost('0.0000');

        $costDetails = json_decode(
            '{"Direction":"*out","Category":"call","Tenant":"b1","Subject":"c1","Account":"c1","Destination":"+34676216531","TOR":"*voice","Cost":0,"Timespans":[{"TimeStart":"2019-01-23T10:48:36Z","TimeEnd":"2019-01-23T10:48:36Z","Cost":0,"RateInterval":null,"DurationIndex":0,"Increments":null,"RoundIncrement":null,"MatchedSubject":"*out:b1:call:c1","MatchedPrefix":"+34","MatchedDestId":"b1dst1","RatingPlanId":"b1rp1","CompressFactor":0}],"RatedUsage":0,"AccountSummary":{"Tenant":"b1","ID":"c1","BalanceSummaries":[{"UUID":"0858029e-bca9-46ab-9601-efa1a6aacf90","ID":"*default","Type":"*monetary","Value":1000,"Disabled":false}],"AllowNegative":false,"Disabled":false}}',
            true
        );
        $dto->setCostDetails(
            $costDetails
        );
        $dto->setExtraInfo('');

        $creationDateTime = new \DateTime(
            '2019-01-23 11:48:42',
            $utc
        );
        $dto->setCreatedAt($creationDateTime);
        $dto->setUpdatedAt($creationDateTime);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TpCdr::class);
    }

    function it_returns_usage_by_casting_usage_to_seconds()
    {
        $this->dto->setUsage(9000000000);

        $this
            ->getDuration()
            ->shouldReturn(9.0);
    }

    function it_extracts_cost_details_savely()
    {
        $dto = clone $this->dto;
        $timeSpans = [
            ['TimeStart' => '2019-01-23T10:48:36Z'],
            [],
            null
        ];

        foreach ($timeSpans as $timeSpan) {
            $costDetails = [
                'Timespans' => [$timeSpan]
            ];
            $dto->setCostDetails($costDetails);

            $this->updateFromDto(
                $dto,
                new \spec\DtoToEntityFakeTransformer()
            );

            $this
                ->getCostDetailsFirstTimespan()
                ->shouldReturn($timeSpan);
        }
    }

    function it_extracts_startTime()
    {
        $this
            ->getStartTime()
            ->shouldBeLike(
                new \DateTime(
                    '2019-01-23 10:48:36',
                    new \DateTimeZone('UTC')
                )
            );
    }

    function it_extracts_ratingPlanTag()
    {
        $this
            ->getRatingPlanTag()
            ->shouldReturn('b1rp1');
    }

    function it_extracts_MatchedDestinationTag()
    {
        $this
            ->getMatchedDestinationTag()
            ->shouldReturn('b1dst1');
    }
}
