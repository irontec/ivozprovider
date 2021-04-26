<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Ivoz\Tests\AccessControlTestHelperTrait;
use Tests\UserAccessControlTestHelperTrait;

class ExtensionTest extends KernelTestCase
{
    use AccessControlTestHelperTrait, UserAccessControlTestHelperTrait {
        UserAccessControlTestHelperTrait::getRepository insteadof AccessControlTestHelperTrait;
    }

    protected function getResourceClass(): string
    {
        return Extension::class;
    }

    protected function getAdminCriteria(): array
    {
        return ['email' => 'alice@democompany.com'];
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
            [],
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
            [],
        );
    }
}
