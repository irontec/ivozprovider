<?php

namespace Tests\Provider\FeaturesRelBrand;

use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;

class FeaturesRelBrandRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var FeaturesRelBrandRepository $repository */
        $repository = $this
            ->em
            ->getRepository(FeaturesRelBrand::class);

        $this->assertInstanceOf(
            FeaturesRelBrandRepository::class,
            $repository
        );
    }
}
