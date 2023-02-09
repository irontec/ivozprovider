<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CallForwardSettingTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return CallForwardSetting::class;
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
                    'or' => [
                        [
                            'user',
                            'in',
                            'UserRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'residentialDevice',
                            'in',
                            'ResidentialDeviceRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'friend',
                            'in',
                            'FriendRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'retailAccount',
                            'in',
                            'RetailAccountRepository([["company","eq","user.getCompany().getId()"]])'
                        ]
                    ]
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
                            'friend',
                            'in',
                            'FriendRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'friend',
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
