<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RatingProfileTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return RatingProfile::class;
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
                            'CompanyRepository([["brand","eq","user.getBrand().getId()"]])'
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
                    'and' => [
                        [
                            'ratingPlanGroup',
                            'in',
                            'RatingPlanGroupRepository([["brand","eq","user.getBrand().getId()"]])'
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
