<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BalanceNotificationTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return BalanceNotification::class;
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
                [
                    'or' => [
                        [
                            'company',
                            'in',
                            'companyRepository.getSupervisedCompanyIdsByAdmin(user)'
                        ],
                        [
                            'carrier',
                            'in',
                            'CarrierRepository([["brand","eq","user.getBrand().getId()"]])'
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
                            'company',
                            'in',
                            'companyRepository.getSupervisedCompanyIdsByAdmin(user)'
                        ],
                        [
                            'company',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'notificationTemplate',
                            'in',
                            'NotificationTemplateRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'notificationTemplate',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'carrier',
                            'in',
                            'CarrierRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'carrier',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
