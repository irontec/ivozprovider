<?php

namespace Tests\Provider\Dispatcher;

use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository;

class DispatcherRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_by_applicationServerId();
    }

    public function its_instantiable()
    {
        /** @var DispatcherRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Dispatcher::class);

        $this->assertInstanceOf(
            DispatcherRepository::class,
            $repository
        );
    }

    public function it_finds_by_applicationServerId()
    {
        /** @var DispatcherRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Dispatcher::class);

        $result = $repository
            ->findByApplicationServerId(1);

        $this->assertCount(2, $result);
        $this->assertInstanceOf(
            Dispatcher::class,
            $result[0]
        );
    }

    public function it_finds_by_applicationServerSetRelApplicationServerId()
    {
        /** @var DispatcherRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Dispatcher::class);

        $result = $repository
            ->findOneByApplicationServerSetRelApplicationServer(1);

        $this->assertInstanceOf(
            DispatcherInterface::class,
            $result
        );
    }
}
