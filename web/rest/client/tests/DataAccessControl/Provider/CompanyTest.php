<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\Company\Company;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CompanyTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return Company::class;
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
                    'id',
                    'eq',
                    'user.getCompany().getId()'
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
                            'id',
                            'eq',
                            'user.getCompany().getId()'
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'outgoingDdi',
                            'in',
                            'DdiRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'outgoingDdi',
                            'isNull',
                            null
                        ]
                    ]
                ],
                [
                    'or' => [
                        [
                            'outgoingDdiRule',
                            'in',
                            'OutgoingDdiRuleRepository([["company","eq","user.getCompany().getId()"]])'
                        ],
                        [
                            'outgoingDdiRule',
                            'isNull',
                            null
                        ]
                    ]
                ]
            ]
        );
    }
}
