<?php

namespace Tests\Provider\UsersXcap;

use Ivoz\Kam\Domain\Model\UsersXcap\UsersXcapInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersXcap\UsersXcap;
use Ivoz\Kam\Domain\Model\UsersXcap\UsersXcapRepository;

class UsersXcapRepositoryTest extends KernelTestCase
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
        /** @var UsersXcapRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersXcap::class);

        $this->assertInstanceOf(
            UsersXcapRepository::class,
            $repository
        );
    }
}
