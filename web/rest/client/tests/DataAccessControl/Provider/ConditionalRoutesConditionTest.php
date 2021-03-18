<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConditionalRoutesConditionTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return ConditionalRoutesCondition::class;
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
                    'conditionalRoute',
                    'in',
                    'ConditionalRouteRepository([["company","eq","user.getCompany().getId()"]])'
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
                            'conditionalRoute',
                            'in',
                            'ConditionalRouteRepository([["company","eq","user.getCompany().getId()"]])'
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'extension',
                            'in',
                            'ExtensionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'extension',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'huntGroup',
                            'in',
                            'HuntGroupRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'huntGroup',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'user',
                            'in',
                            'UserRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'user',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'queue',
                            'in',
                            'QueueRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'queue',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'locution',
                            'in',
                            'LocutionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'locution',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'conferenceRoom',
                            'in',
                            'ConferenceRoomRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'conferenceRoom',
                            'isNull',
                            null
                        ]
                    ]

                ]
            ]
        );
    }
}
