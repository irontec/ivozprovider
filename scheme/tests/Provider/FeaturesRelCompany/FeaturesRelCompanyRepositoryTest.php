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
}
