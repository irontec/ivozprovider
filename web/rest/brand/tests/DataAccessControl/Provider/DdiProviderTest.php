<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DdiProviderTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return DdiProvider::class;
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
                        ],
                        [
                            'mediaRelaySet',
                            'in',
                            'MediaRelaySetRepository([["id","IN",["mediaRelaySetsRelBrandRepository.getMediaRelaySetIdsByBrandAdmin(user)"]]])'
                        ],
                    ],
                ],
                [
                    'or' => [
                        [
                            'routingTag',
                            'in',
                            'RoutingTagRepository([["brand","eq","user.getBrand().getId()"]])'
                        ],
                        [
                            'routingTag',
                            'isNull',
                            null
                        ]
                    ],
                ]
            ]
        );
    }
}
