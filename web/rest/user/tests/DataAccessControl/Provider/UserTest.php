<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\User\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Ivoz\Tests\AccessControlTestHelperTrait;
use Tests\UserAccessControlTestHelperTrait;

class UserTest extends KernelTestCase
{
    use AccessControlTestHelperTrait, UserAccessControlTestHelperTrait {
        UserAccessControlTestHelperTrait::getRepository insteadof AccessControlTestHelperTrait;
    }

    protected function getResourceClass(): string
    {
        return User::class;
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
