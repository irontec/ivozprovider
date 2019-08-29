<?php

namespace Tests\Provider\UsersActiveWatcher;

use Ivoz\Kam\Domain\Model\UsersActiveWatcher\UsersActiveWatcherInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersActiveWatcher\UsersActiveWatcher;
use Ivoz\Kam\Domain\Model\UsersActiveWatcher\UsersActiveWatcherRepository;

class UsersActiveWatcherRepositoryTest extends KernelTestCase
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
        /** @var UsersActiveWatcherRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersActiveWatcher::class);

        $this->assertInstanceOf(
            UsersActiveWatcherRepository::class,
            $repository
        );
    }
}
