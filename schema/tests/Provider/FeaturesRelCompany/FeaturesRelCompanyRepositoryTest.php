<?php

namespace Tests\Provider\FeaturesRelCompany;

use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;

class FeaturesRelCompanyRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
    }

    public function its_instantiable()
    {
        /** @var FeaturesRelCompanyRepository $featuresRelCompanyRepository */
        $featuresRelCompanyRepository = $this
            ->em
            ->getRepository(FeaturesRelCompany::class);

        $this->assertInstanceOf(
            FeaturesRelCompanyRepository::class,
            $featuresRelCompanyRepository
        );
    }

    public function it_finds_feature_idens_by_company_id()
    {
        /** @var FeaturesRelCompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(FeaturesRelCompany::class);

        $idens = $repository->findFeatureIdensByCompanyId(1);

        $this->assertIsArray(
            $idens
        );

        $this->assertIsString(
            $idens[0]
        );
    }

    public function it_is_feature_in_use_by_brand()
    {
        /** @var FeaturesRelCompanyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Company::class);

        $isFeatureInUse = $repository->isFeatureInUseByBrandId(1, 1);

        $this->assertEquals(
            $isFeatureInUse,
            true
        );
    }
}
