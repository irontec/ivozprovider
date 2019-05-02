<?php

namespace Tests\Provider\UsersLocation;

use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocation;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;

class UsersLocationRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var UsersLocationRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersLocation::class);

        $this->assertInstanceOf(
            UsersLocationRepository::class,
            $repository
        );
    }
}
