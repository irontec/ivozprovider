<?php

namespace Tests\Provider\UsersHtable;

use Ivoz\Kam\Domain\Model\UsersHtable\UsersHtableInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersHtable\UsersHtable;
use Ivoz\Kam\Domain\Model\UsersHtable\UsersHtableRepository;

class UsersHtableRepositoryTest extends KernelTestCase
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
        /** @var UsersHtableRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersHtable::class);

        $this->assertInstanceOf(
            UsersHtableRepository::class,
            $repository
        );
    }
}
