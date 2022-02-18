<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HuntGroupsRelUserTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return HuntGroupsRelUser::class;
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
                [
                    'huntGroup',
                    'in',
                    'HuntGroupRepository([["company","eq","user.getCompany().getId()"]])'
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
                            'huntGroup',
                            'in',
                            'HuntGroupRepository([["company","eq","user.getCompany().getId()"]])',
                        ],
                    ],
                ],
                [
                    'or' => [
                        [
                            'user',
                            'in',
                            'UserRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'user',
                            'isNull',
                            null
                        ],
                    ],
                ],
            ]
        );
    }
}
