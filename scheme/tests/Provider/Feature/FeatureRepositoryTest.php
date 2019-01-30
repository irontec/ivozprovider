<?php

namespace Tests\Provider\Feature;

use Ivoz\Provider\Domain\Model\Feature\FeatureRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Feature\Feature;

class FeatureRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var FeatureRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Feature::class);

        $this->assertInstanceOf(
            FeatureRepository::class,
            $repository
        );
    }
}
