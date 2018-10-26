<?php

namespace Tests\Provider\DdiProvider;

use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

class DdiProviderRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var DdiProviderRepository $repository */
        $repository = $this
            ->em
            ->getRepository(DdiProvider::class);

        $this->assertInstanceOf(
            DdiProviderRepository::class,
            $repository
        );
    }
}