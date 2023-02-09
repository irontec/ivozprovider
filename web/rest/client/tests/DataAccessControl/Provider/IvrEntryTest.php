<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IvrEntryTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return IvrEntry::class;
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
                    'ivr',
                    'in',
                    'IvrRepository([["company","eq","user.getCompany().getId()"]])'
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
                            'ivr',
                            'in',
                            'IvrRepository([["company","eq","user.getCompany().getId()"]])'
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
                            'welcomeLocution',
                            'in',
                            'LocutionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'welcomeLocution',
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
                ]
            ]
        );
    }
}
