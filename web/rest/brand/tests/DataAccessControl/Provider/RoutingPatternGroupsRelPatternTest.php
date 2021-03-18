<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RoutingPatternGroupsRelPatternTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return RoutingPatternGroupsRelPattern::class;
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
                    'routingPatternGroup',
                    'in',
                    'RoutingPatternGroupRepository([["brand","eq","user.getBrand().getId()"]])'
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
                    'routingPatternGroup',
                    'in',
                    'RoutingPatternGroupRepository([["brand","eq","user.getBrand().getId()"]])'
                ],
                [
                    'routingPattern',
                    'in',
                    'RoutingPatternRepository([["brand","eq","user.getBrand().getId()"]])'
                ]
            ]
        );
    }
}
