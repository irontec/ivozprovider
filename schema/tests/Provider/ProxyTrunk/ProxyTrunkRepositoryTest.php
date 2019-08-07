<?php

namespace Tests\Provider\ProxyTrunk;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

class ProxyTrunkRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_main_address_proxy();
    }

    public function its_instantiable()
    {
        /** @var ProxyTrunkRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ProxyTrunk::class);

        $this->assertInstanceOf(
            ProxyTrunkRepository::class,
            $repository
        );
    }

    public function it_finds_main_address_proxy()
    {
        /** @var ProxyTrunkRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ProxyTrunk::class);

        $mainProxy = $repository->getProxyMainAddress();

        $this->assertInstanceOf(
            ProxyTrunk::class,
            $mainProxy
        );
    }
}
