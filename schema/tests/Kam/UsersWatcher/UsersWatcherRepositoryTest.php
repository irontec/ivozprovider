<?php

namespace Tests\Provider\UsersWatcher;

use Ivoz\Kam\Domain\Model\UsersWatcher\UsersWatcherInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersWatcher\UsersWatcher;
use Ivoz\Kam\Domain\Model\UsersWatcher\UsersWatcherRepository;

class UsersWatcherRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
    }

    public function its_instantiable()
    {
        /** @var UsersWatcherRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersWatcher::class);

        $this->assertInstanceOf(
            UsersWatcherRepository::class,
            $repository
        );
    }
}
