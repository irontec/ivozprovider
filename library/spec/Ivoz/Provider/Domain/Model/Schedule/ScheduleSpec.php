<?php

namespace spec\Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Schedule\Schedule;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleDto;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class ScheduleSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var ScheduleDto */
    protected $dto;
    protected $utc;
    protected $europeMadrid;

    protected $initialTimeIn = '20:00:00';

    function let()
    {
        $this->dto = $dto = new ScheduleDto();

        $this->utc = new \DateTimeZone('UTC');
        $this->europeMadrid = new \DateTimeZone('Europe/Madrid');

        $timeIn = new \DateTime(
            $this->initialTimeIn,
            $this->utc
        );

        $timeOut = new \DateTime(
            '23:59:59',
            $this->utc
        );

        $companyDto = new CompanyDto();

        $dto
            ->setName('testSchedule')
            ->setTimeIn($timeIn)
            ->setTimeout($timeOut)
            ->setMonday(true)
            ->setTuesday(true)
            ->setWednesday(true)
            ->setThursday(true)
            ->setFriday(true)
            ->setSaturday(true)
            ->setSunday(true)
            ->setCompany($companyDto);

        $company = $this->getTestDouble(
            CompanyInterface::class
        );

        $transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company->reveal()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Schedule::class);
    }

    function it_tells_whether_is_on_schedule()
    {
        $time = new \DateTime(
            $this->initialTimeIn,
            $this->utc
        );

        $this
            ->isOnSchedule($time)
            ->shouldReturn(true);
    }


    function it_unifies_time_zones()
    {
        $time = new \DateTime(
            '23:59:58',
            $this->europeMadrid
        );

        $this
            ->isOnSchedule($time)
            ->shouldReturn(true);
    }

    function it_tells_whether_is_not_on_schedule()
    {
        $time = new \DateTime(
            '19:00:00',
            $this->utc
        );

        $this
            ->isOnSchedule($time)
            ->shouldReturn(false);
    }

    function it_checks_day_of_the_week()
    {
        $this->dto
            ->setMonday(false)
            ->setTuesday(false)
            ->setWednesday(false)
            ->setThursday(false)
            ->setFriday(false)
            ->setSaturday(false)
            ->setSunday(false);

        $time = new \DateTime(
            $this->initialTimeIn,
            $this->europeMadrid
        );

        $this
            ->isOnSchedule($time)
            ->shouldReturn(false);
    }
}
