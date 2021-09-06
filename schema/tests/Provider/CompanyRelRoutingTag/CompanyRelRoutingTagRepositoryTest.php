<?php

namespace Tests\Provider\CompanyRelRoutingTag;

use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTag;

class CompanyRelRoutingTagRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_gets_routing_tag_ids_by_company();
    }

    public function its_instantiable()
    {
        /** @var CompanyRelRoutingTagRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CompanyRelRoutingTag::class);

        $this->assertInstanceOf(
            CompanyRelRoutingTagRepository::class,
            $repository
        );
    }

    public function it_gets_routing_tag_ids_by_company()
    {
        /** @var CompanyRelRoutingTagRepository $companyRelRoutingTagRepository */
        $companyRelRoutingTagRepository = $this->em
            ->getRepository(CompanyRelRoutingTag::class);

        $ratingPlanGroupIds = $companyRelRoutingTagRepository
            ->getRoutingTagIdsByCompany(3);

        $this->assertInternalType(
            'array',
            $ratingPlanGroupIds
        );

        $this->assertInternalType(
            'int',
            $ratingPlanGroupIds[0]
        );
    }
}
