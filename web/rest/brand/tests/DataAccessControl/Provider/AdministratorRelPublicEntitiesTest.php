<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AdministratorRelPublicEntitiesTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return AdministratorRelPublicEntity::class;
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
                ['administrator', 'in', 'AdministratorRepository([["company","IN",["companyRepository.getSupervisedCompanyIdsByAdmin(user)"]],["internal","neq","1"]])'],
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
                ['administrator', 'in', 'AdministratorRepository([["company","IN",["companyRepository.getSupervisedCompanyIdsByAdmin(user)"]],["internal","neq","1"]])'],
                ['publicEntity', 'in', 'PublicEntityRepository([["client","eq","1"]])'],
            ]
        );
    }
}
