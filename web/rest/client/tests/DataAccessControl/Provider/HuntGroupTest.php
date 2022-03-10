<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HuntGroupTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return HuntGroup::class;
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
                            'noAnswerLocution',
                            'in',
                            'LocutionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'noAnswerLocution',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'noAnswerExtension',
                            'in',
                            'ExtensionRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'noAnswerExtension',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'noAnswerVoicemail',
                            'in',
                            'VoicemailRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'noAnswerVoicemail',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
