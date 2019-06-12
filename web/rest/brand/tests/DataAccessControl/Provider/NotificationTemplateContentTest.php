<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContent;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NotificationTemplateContentTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass()
    {
        return NotificationTemplateContent::class;
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
                    'notificationTemplate',
                    'in',
                    'NotificationTemplateRepository({"or":[["brand","eq","user.getCompany().getBrand().getId()"],["brand","eq",null]]})'
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
                    'notificationTemplate',
                    'in',
                    'NotificationTemplateRepository({"or":[["brand","eq","user.getCompany().getBrand().getId()"],["brand","eq",null]]})'
                ]
            ]
        );
    }
}
