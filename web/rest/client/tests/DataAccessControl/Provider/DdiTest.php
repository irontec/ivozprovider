<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DdiTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Ddi::class;
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
                            'fax',
                            'in',
                            'FaxRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'fax',
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
                            'retailAccount',
                            'in',
                            'RetailAccountRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'retailAccount',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'residentialDevice',
                            'in',
                            'ResidentialDeviceRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'residentialDevice',
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
                            'externalCallFilter',
                            'in',
                            'ExternalCallFilterRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'externalCallFilter',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
