<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OutgoingRoutingTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return OutgoingRouting::class;
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
                ],
                [
                    'or' => [
                        [
                            'company',
                            'in',
                            'CompanyRepository([["brand","eq","user.getBrand().getId()"]])'
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
                            'routingPattern',
                            'in',
                            'RoutingPatternRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'routingPattern',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'routingPatternGroup',
                            'in',
                            'RoutingPatternGroupRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'routingPatternGroup',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
