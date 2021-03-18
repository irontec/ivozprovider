<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceTemplateTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return InvoiceTemplate::class;
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
                    'or' => [
                        [
                            'brand',
                            'eq',
                            'user.getBrand().getId()'
                        ],
                        [
                            'brand',
                            'isNull',
                            null
                        ]
                    ]
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
                    'brand',
                    'eq',
                    'user.getBrand().getId()'
                ]
            ]
        );
    }
}
