<?php

namespace Tests\Provider\Service;

use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Service\Service;

class ServiceRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->its_services_in_group();
    }

    public function its_instantiable()
    {
        /** @var ServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Service::class);

        $this->assertInstanceOf(
            ServiceRepository::class,
            $repository
        );
    }

    public function its_services_in_group()
    {
        /** @var ServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Service::class);

        $results = $repository->getServicesInGroup([1]);

        $this->assertIsArray(
            $results
        );

        $this->assertInstanceOf(
            ServiceInterface::class,
            $results[0]
        );
    }


    public function its_finds_services_by_brandId()
    {
        /** @var ServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Service::class);

        $results = $repository->getServiceIdsByBrand(1);

        $this->assertIsArray(
            $results
        );

        $this->assertIsInt(
            $results[0]
        );
    }
}
