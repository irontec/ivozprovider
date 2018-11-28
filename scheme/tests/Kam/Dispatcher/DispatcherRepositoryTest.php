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

    /**
     * @test
     */
    public function it_finds_by_applicationServerId()
    {
        /** @var DispatcherRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Dispatcher::class);

        $result = $repository
            ->findOneByApplicationServerId(1);

        $this->assertInstanceOf(
            DispatcherInterface::class,
            $result
        );
    }
}