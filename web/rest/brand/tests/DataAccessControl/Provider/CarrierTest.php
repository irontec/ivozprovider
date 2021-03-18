<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CarrierTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Carrier::class;
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
                        ],
                        [
                            'transformationRuleSet',
                            'in',
                            'TransformationRuleSetRepository({"or":[["brand","eq","user.getBrand().getId()"],["brand","eq",null]]})'
                        ]
                    ]
                ]
            ]
        );
    }
}
