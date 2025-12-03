<?php

namespace Tests\Provider\TrunksLcrGateway;

use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Infrastructure\Persistence\Doctrine\TrunksLcrGatewayDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class TrunksLcrGatewayRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_lcr_gateway_by_carrier_server_id();
    }

    public function it_finds_lcr_gateway_by_carrier_server_id()
    {
        /** @var TrunksLcrGatewayDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksLcrGateway::class);

        $result = $repository->findByCarrierServerId(1);

        $this->assertInstanceOf(
            TrunksLcrGatewayInterface::class,
            $result
        );
    }
}
