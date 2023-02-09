<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExtensionTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Extension::class;
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
                    'company',
                    'eq',
                    'user.getCompany().getId()'
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
                            'company',
                            'eq',
                            'user.getCompany().getId()'
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
                            'conditionalRoute',
                            'in',
                            'ConditionalRouteRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'conditionalRoute',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'ivr',
                            'in',
                            'IvrRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'ivr',
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
                ],
                [
                    'or' => [
                        [
                            'voicemail',
                            'in',
                            'VoicemailRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'voicemail',
                            'isNull',
                            null
                        ]
                    ]
                ],
            ]
        );
    }
}
