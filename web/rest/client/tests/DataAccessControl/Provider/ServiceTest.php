<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Service\Service;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ServiceTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Service::class;
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
            ]
        );
    }
}
