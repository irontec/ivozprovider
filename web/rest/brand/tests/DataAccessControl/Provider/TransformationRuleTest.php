<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRule;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TransformationRuleTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return TransformationRule::class;
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
                    'transformationRuleSet',
                    'in',
                    'TransformationRuleSetRepository({"or":[["brand","eq","user.getBrand().getId()"],["brand","eq",null]]})'
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
                    'transformationRuleSet',
                    'in',
                    'transformationRuleSetRepository.getIdsByBrandId(user.getBrand().getId())'
                ]
            ]
        );
    }
}
