<?php

namespace Tests\DataAccessControl\Provider;

use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlist;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConditionalRoutesConditionsRelMatchlistTest extends KernelTestCase
{
    use \Ivoz\Tests\AccessControlTestHelperTrait;

    protected function getResourceClass(): string
    {
        return ConditionalRoutesConditionsRelMatchlist::class;
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
                    'matchlist',
                    'in',
                    'MatchListRepository({"or":[["brand","eq","user.getCompany().getBrand().getId()"],["company","eq","user.getCompany().getId()"]]})'
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
                    'matchlist',
                    'in',
                    'MatchListRepository({"or":[["brand","eq","user.getCompany().getBrand().getId()"],["company","eq","user.getCompany().getId()"]]})'
                ],
                [
                    'condition',
                    'in',
                    'ConditionalRoutesConditionRepository([["conditionalRoute","IN",["ConditionalRouteRepository([[\"company\",\"eq\",\"user.getCompany().getId()\"]])"]]])'
                ]
            ]
        );
    }
}
