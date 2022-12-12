<?php

namespace Tests\Provider\CarrierServer;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\CarrierDoctrineRepository;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\CarrierServerDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class CarrierServerRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_carrier_server_by_carrierId();
    }

    public function it_finds_carrier_server_by_carrierId()
    {
        /** @var CarrierServerDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(CarrierServer::class);

        $result = $repository->findByCarrierId(1);

        $this->assertInstanceOf(
            CarrierServer::class,
            $result[0]
        );
    }
}
