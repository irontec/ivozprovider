<?php

namespace Tests\Provider\UsersPua;

use Ivoz\Kam\Domain\Model\UsersPua\UsersPuaInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\UsersPua\UsersPua;
use Ivoz\Kam\Domain\Model\UsersPua\UsersPuaRepository;

class UsersPuaRepositoryTest extends KernelTestCase
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
        /** @var UsersPuaRepository $repository */
        $repository = $this
            ->em
            ->getRepository(UsersPua::class);

        $this->assertInstanceOf(
            UsersPuaRepository::class,
            $repository
        );
    }
}
