<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IvrTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Ivr::class;
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
                            'errorExtension',
                            'in',
                            'ExtensionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'errorExtension',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'errorLocution',
                            'in',
                            'LocutionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'errorLocution',
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
                            'noInputLocution',
                            'in',
                            'LocutionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'noInputLocution',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'successLocution',
                            'in',
                            'LocutionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'successLocution',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'noInputVoicemail',
                            'in',
                            'VoicemailRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'noInputVoicemail',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'errorVoicemail',
                            'in',
                            'VoicemailRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'errorVoicemail',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'noInputExtension',
                            'in',
                            'ExtensionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'noInputExtension',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
