<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DestinationRateTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return DestinationRate::class;
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
                    'destinationRateGroup',
                    'in',
                    'DestinationRateGroupRepository([["brand","eq","user.getBrand().getId()"]])'
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
                    'destinationRateGroup',
                    'in',
                    'DestinationRateGroupRepository([["brand","eq","user.getBrand().getId()"]])'
                ],
                [
                    'destination',
                    'in',
                    'DestinationRepository([["brand","eq","user.getBrand().getId()"]])'
                ]
            ]
        );
    }
}
