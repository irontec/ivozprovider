<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Company\Company;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CompanyTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Company::class;
    }

    protected function getAdminCriteria(): array
    {
        return ['username' => 'test_brand_admin'];
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
                ['brand', 'eq', 'user.getBrand().getId()']
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
                            'brand',
                            'eq',
                            'user.getBrand().getId()'
                        ],
                        [
                            'transformationRuleSet',
                            'in',
                            'TransformationRuleSetRepository({"or":[["brand","eq","user.getBrand().getId()"],["brand","eq",null]]})'
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'voicemailNotificationTemplate',
                            'in',
                            'NotificationTemplateRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'voicemailNotificationTemplate',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'callCsvNotificationTemplate',
                            'in',
                            'NotificationTemplateRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'callCsvNotificationTemplate',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'invoiceNotificationTemplate',
                            'in',
                            'NotificationTemplateRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'invoiceNotificationTemplate',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'faxNotificationTemplate',
                            'in',
                            'NotificationTemplateRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'faxNotificationTemplate',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
