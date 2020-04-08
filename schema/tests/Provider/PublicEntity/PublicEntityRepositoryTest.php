<?php

namespace Tests\Provider\PublicEntity;

use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntity;

class PublicEntityRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_client_entities();
        $this->it_finds_brand_entities();
        $this->it_finds_platform_entities();
    }

    public function its_instantiable()
    {
        /** @var PublicEntityRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PublicEntity::class);

        $this->assertInstanceOf(
            PublicEntityRepository::class,
            $repository
        );
    }

    public function it_finds_client_entities()
    {
        /** @var PublicEntityRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PublicEntity::class);


        $response = $repository->findClientEntities();

        $this->assertNotEmpty(
            $response
        );

        $this->assertInstanceOf(
            PublicEntity::class,
            $response[0]
        );

        $this->assertTrue(
            $response[0]->getClient()
        );
    }

    public function it_finds_brand_entities()
    {
        /** @var PublicEntityRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PublicEntity::class);


        $response = $repository->findBrandEntities();

        $this->assertNotEmpty(
            $response
        );

        $this->assertInstanceOf(
            PublicEntity::class,
            $response[0]
        );

        $this->assertTrue(
            $response[0]->getBrand()
        );
    }


    public function it_finds_platform_entities()
    {
        /** @var PublicEntityRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PublicEntity::class);


        $response = $repository->findPlatformEntities();

        $this->assertNotEmpty(
            $response
        );

        $this->assertInstanceOf(
            PublicEntity::class,
            $response[0]
        );

        $this->assertTrue(
            $response[0]->getPlatform()
        );
    }
}
