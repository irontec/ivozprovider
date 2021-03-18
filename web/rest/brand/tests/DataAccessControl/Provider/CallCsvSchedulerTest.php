<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CallCsvSchedulerTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return CallCsvScheduler::class;
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
                    'brand',
                    'eq',
                    'user.getBrand().getId()'
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
                            'brand',
                            'eq',
                            'user.getBrand().getId()'
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
                        ],
                    ]
                ],
                [
                    'or' => [
                        [
                            'ddi',
                            'in',
                            'DdiRepository([["brand","eq","user.getBrand().getId()"],["company","IN",["companyRepository.getSupervisedCompanyIdsByAdmin(user)"]]])'
                        ],
                        [
                            'ddi',
                            'isNull',
                            null
                        ],
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
                        ],
                    ]
                ],
                [
                    'or' => [
                        [
                            'retailAccount',
                            'in',
                            'RetailAccountRepository([["brand","eq","user.getBrand().getId()"],["company","IN",["companyRepository.getSupervisedCompanyIdsByAdmin(user)"]]])'
                        ],
                        [
                            'retailAccount',
                            'isNull',
                            null
                        ],
                    ]
                ],
                [
                    'or' => [
                        [
                            'residentialDevice',
                            'in',
                            'ResidentialDeviceRepository([["brand","eq","user.getBrand().getId()"],["company","IN",["companyRepository.getSupervisedCompanyIdsByAdmin(user)"]]])'
                        ],
                        [
                            'residentialDevice',
                            'isNull',
                            null
                        ],
                    ]
                ],
                [
                    'or' => [
                        [
                            'ddiProvider',
                            'in',
                            'DdiProviderRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'ddiProvider',
                            'isNull',
                            null
                        ],
                    ]
                ],
            ]
        );
    }
}
