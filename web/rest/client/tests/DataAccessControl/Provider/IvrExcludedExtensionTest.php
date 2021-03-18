<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IvrExcludedExtensionTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return IvrExcludedExtension::class;
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
                    'ivr',
                    'in',
                    'IvrRepository([["company","eq","user.getCompany().getId()"]])'
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
                    'ivr',
                    'in',
                    'IvrRepository([["company","eq","user.getCompany().getId()"]])'
                ],
                [
                    'extension',
                    'in',
                    'ExtensionRepository([["company","eq","user.getCompany().getId()"]])'
                ]
            ]
        );
    }
}
