<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OutgoingDdiRulesPatternTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return OutgoingDdiRulesPattern::class;
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
                [
                    'outgoingDdiRule',
                    'in',
                    'OutgoingDdiRuleRepository([["company","eq","user.getCompany().getId()"]])'
                ]
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
                        [
                            'outgoingDdiRule',
                            'in',
                            'OutgoingDdiRuleRepository([["company","eq","user.getCompany().getId()"]])'
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'matchList',
                            'in',
                            'MatchListRepository({"or":[["brand","eq","user.getCompany().getBrand().getId()"],["company","eq","user.getCompany().getId()"]]})'
                        ],
                        [
                            'matchList',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'forcedDdi',
                            'in',
                            'DdiRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'forcedDdi',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
