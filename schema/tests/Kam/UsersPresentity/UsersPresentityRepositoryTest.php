<?php

namespace Tests\Provider\UsersPresentity;

use Ivoz\Kam\Domain\Model\UsersPresentity\UsersPresentityInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersPresentity\UsersPresentity;
use Ivoz\Kam\Domain\Model\UsersPresentity\UsersPresentityRepository;

class UsersPresentityRepositoryTest extends KernelTestCase
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
        /** @var UsersPresentityRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersPresentity::class);

        $this->assertInstanceOf(
            UsersPresentityRepository::class,
            $repository
        );
    }
}
