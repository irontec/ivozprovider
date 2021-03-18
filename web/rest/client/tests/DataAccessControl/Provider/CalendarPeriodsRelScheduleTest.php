<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelSchedule;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalendarPeriodsRelScheduleTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return CalendarPeriodsRelSchedule::class;
    }

    protected function getAdminCriteria(): array
    {
        return ['username' => 'test_company_admin'];
    }

    /**
     * @test
     */
    function it_has_read_access_control()
    {
        $accessControl = $this
            ->dataAccessControlParser
            ->get(
                DataAccessControlParser::READ_ACCESS_CONTROL_ATTRIBUTE
            );

        $this->assertEquals(
            $accessControl,
            [
                ['schedule', 'in', 'ScheduleRepository([["company","eq","user.getCompany().getId()"]])']
            ]
        );
    }

    /**
     * @test
     */
    function it_has_write_access_control()
    {
        $accessControl = $this
            ->dataAccessControlParser
            ->get(
                DataAccessControlParser::WRITE_ACCESS_CONTROL_ATTRIBUTE
            );

        $this->assertEquals(
            $accessControl,
            [
                [
                    'calendarPeriod',
                    'in',
                    'CalendarPeriodRepository([["calendar","IN",["CalendarRepository([[\\"company\\",\\"eq\\",\\"user.getCompany().getId()\\"]])"]]])',
                ],
                [
                    'schedule',
                    'in',
                    'ScheduleRepository([["company","eq","user.getCompany().getId()"]])',
                ],
            ]
        );
    }
}
