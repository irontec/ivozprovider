<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FaxesInOutTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return FaxesInOut::class;
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
                    'fax',
                    'in',
                    'FaxRepository([["company","eq","user.getCompany().getId()"]])'
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
                    'type',
                    'eq',
                    '"Out"'
                ],
                [
                    'fax',
                    'in',
                    'FaxRepository([["company","eq","user.getCompany().getId()"]])'
                ],
            ]
        );
    }

    /**
     * @test
     */
    function it_has_delete_access_control()
    {
        $accessControl = $this
            ->dataAccessControlParser
            ->get(
                DataAccessControlParser::DELETE_ACCESS_CONTROL_ATTRIBUTE
            );

        $this->assertEquals(
            $accessControl,
            [
                [
                    'fax',
                    'in',
                    'FaxRepository([["company","eq","user.getCompany().getId()"]])'
                ]
            ]
        );
    }
}
