<?php

namespace Tests\Provider\UsersAddress;

use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddress;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressRepository;

class UsersAddressRepositoryTest extends KernelTestCase
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
        /** @var UsersAddressRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersAddress::class);

        $this->assertInstanceOf(
            UsersAddressRepository::class,
            $repository
        );
    }
}
