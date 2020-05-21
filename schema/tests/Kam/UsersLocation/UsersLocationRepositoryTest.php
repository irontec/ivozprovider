<?php

namespace Tests\Kam\UsersLocation;

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
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_domain_and_user();
        $this->it_finds_many_by_domain_and_user();
        $this->it_finds_by_domains();
    }

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

    public function it_finds_one_by_domain_and_user()
    {
        /** @var UsersLocationRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersLocation::class);

        $userLocation = $repository->findOneByDomainUser(
            '127.0.0.1',
            'alice'
        );

        $this->assertInstanceOf(
            UsersLocation::class,
            $userLocation
        );
    }

    public function it_finds_many_by_domain_and_user()
    {
        /** @var UsersLocationRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersLocation::class);

        $userLocations = $repository->findByUsernameAndDomain(
            'alice',
            '127.0.0.1'
        );

        $this->assertNotEmpty(
            $userLocations
        );

        $this->assertInstanceOf(
            UsersLocation::class,
            $userLocations[0]
        );
    }

    public function it_finds_by_domains()
    {
        /** @var UsersLocationRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersLocation::class);

        $userLocations = $repository->findByDomains(
            [
                '127.0.0.1',
                'users.ivozprovider.local'
            ]
        );

        $this->assertNotEmpty(
            $userLocations
        );

        $this->assertInstanceOf(
            UsersLocation::class,
            $userLocations[0]
        );
    }
}
