<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalendarPeriodTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return CalendarPeriod::class;
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
                ['calendar', 'in', 'CalendarRepository([["company","eq","user.getCompany().getId()"]])']
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
                    'and' => [
                        ['calendar', 'in', 'CalendarRepository([["company","eq","user.getCompany().getId()"]])']
                    ]
                ],
                [
                    'or' => [
                        ['voicemail', 'in', 'VoicemailRepository([["company","eq","user.getCompany().getId()"]])'],
                        ['voicemail', 'isNull', null]
                    ]
                ],
                [
                    'or' => [
                        ['extension', 'in', 'ExtensionRepository([["company","eq","user.getCompany().getId()"]])'],
                        ['extension', 'isNull', null]
                    ]
                ],
                [
                    'or' => [
                        ['locution', 'in', 'LocutionRepository([["company","eq","user.getCompany().getId()"]])'],
                        ['locution', 'isNull', null]
                    ]
                ]
            ]
        );
    }
}
