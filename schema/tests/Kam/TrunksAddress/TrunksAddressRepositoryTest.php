<?php

namespace Tests\Provider\TrunksAddress;

use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddress;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressRepository;

class TrunksAddressRepositoryTest extends KernelTestCase
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
        /** @var TrunksAddressRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksAddress::class);

        $this->assertInstanceOf(
            TrunksAddressRepository::class,
            $repository
        );
    }
}
