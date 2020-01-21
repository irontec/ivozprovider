<?php

namespace Tests\DataAccessControl\Kam;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UsersCdrTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass()
    {
        return UsersCdr::class;
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
                ['brand', 'eq', 'user.getBrand().getId()'],
                ['hidden', 'eq', 0],
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
                ['brand', 'eq', 'user.getBrand().getId()'],
                ['hidden', 'eq', 0],
            ]
        );
    }
}
