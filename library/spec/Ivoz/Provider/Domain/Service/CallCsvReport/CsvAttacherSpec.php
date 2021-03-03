<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Service\BillableCall\CsvExporter;
use Ivoz\Provider\Domain\Service\CallCsvReport\CsvAttacher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Symfony\Component\Filesystem\Filesystem;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;

class CsvAttacherSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $csvExporter;
    protected $fs;

    protected $callCsvReport;
    protected $callCsvReportDto;

    public function let(
        EntityTools $entityTools,
        CsvExporter $csvExporter,
        Filesystem $fs,
        CallCsvReportInterface $callCsvReport,
        CallCsvReportDto $callCsvReportDto,
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->entityTools = $entityTools;
        $this->csvExporter = $csvExporter;
        $this->fs = $fs;

        $this->callCsvReport = $callCsvReport;
        $this->callCsvReportDto = $callCsvReportDto;

        $this->prepareExecution(
            $callCsvReport,
            $callCsvReportDto,
            $scheduler
        );

        $this->beConstructedWith(...func_get_args());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvAttacher::class);
    }

    function it_does_nothing_if_not_new()
    {
        $this
            ->callCsvReport
            ->isNew()
            ->willReturn(false);

        $this
            ->callCsvReport
            ->getInDate()
            ->shouldNotBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    function it_does_nothing_if_scheduler_is_empty()
    {
        $this
            ->callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null);

        $this
            ->callCsvReport
            ->getInDate()
            ->shouldNotBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    function it_uses_company_name_and_date_range_in_csv_name()
    {
        $this
            ->callCsvReportDto
            ->setCsvBaseName('CompanyName-20180101-20180101.csv')
            ->willReturn($this->callCsvReportDto)
            ->shouldBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    function it_uses_brand_name_in_csv_name_when_company_is_empty()
    {
        $this
            ->callCsvReport
            ->getCompany()
            ->willReturn(null);

        $this->callCsvReportDto
            ->setCsvBaseName(Argument::containingString('BrandName-'))
            ->willReturn($this->callCsvReportDto)
            ->shouldBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    function it_makes_timezone_conversions_on_csv_file_name_dates()
    {
        $timezone = $this->getInstance(
            Timezone::class,
            [
                'tz' => 'Europe/Madrid'
            ]
        );

        $this
            ->callCsvReport
            ->getTimezone()
            ->willReturn($timezone)
            ->shouldBeCalled();

        $inDate = new \DateTime('2018-01-01 23:00:00');
        $outDate = new \DateTime('2018-01-02 22:59:59');
        $this->getterProphecy(
            $this->callCsvReport,
            [
                'getInDate' => $inDate,
                'getOutDate' => $outDate
            ],
            true
        );

        $this
            ->callCsvReportDto
            ->setCsvBaseName('CompanyName-20180102-20180102.csv')
            ->willReturn($this->callCsvReportDto);

        $this->execute(
            $this->callCsvReport
        );
    }

    function it_persists_csv()
    {
        $this
            ->entityTools
            ->updateEntityByDto(
                $this->callCsvReport,
                $this->callCsvReportDto
            )
            ->willReturn($this->callCsvReport)
            ->shouldBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    private function prepareExecution(
        CallCsvReportInterface $callCsvReport,
        CallCsvReportDto $callCsvReportDto,
        CallCsvSchedulerInterface $scheduler
    ) {
        $company = $this->getInstance(
            Company::class,
            [
                'name' => 'CompanyName'
            ]
        );

        $brand = $this->getInstance(
            Brand::class,
            [
                'name' => 'BrandName'
            ]
        );

        $timezone = $this->getInstance(
            Timezone::class,
            [
                'tz' => 'UTC'
            ]
        );

        $inDate = new \DateTime('2018-01-01 00:00:00');
        $outDate = new \DateTime('2018-01-01 23:59:59');
        $this->getterProphecy(
            $callCsvReport,
            [
                'isNew' => true,
                'getInDate' => $inDate,
                'getOutDate' => $outDate,
                'getCompany' => $company,
                'getBrand' => $brand,
                'getTimezone' => $timezone,
                'getCallCsvScheduler' => $scheduler->getWrappedObject(),
            ],
            false
        );

        $this
            ->csvExporter
            ->execute(
                Argument::type('DateTime'),
                Argument::type('DateTime'),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->willReturn('CsvContent');

        $this
            ->entityTools
            ->entityToDto($callCsvReport)
            ->willReturn($callCsvReportDto);

        $callCsvReportDto
            ->setCsvPath(Argument::type('string'))
            ->willReturn($callCsvReportDto);

        $callCsvReportDto
            ->setCsvBaseName(Argument::type('string'))
            ->willReturn($callCsvReportDto);

        $this
            ->entityTools
            ->updateEntityByDto(
                $callCsvReport,
                $callCsvReportDto
            )
            ->willReturn($callCsvReport);
    }
}
