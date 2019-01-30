<?php

namespace Tests\Provider\ProxyUser;

use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;

class ProxyUserRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ProxyUserRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ProxyUser::class);

        $this->assertInstanceOf(
            ProxyUserRepository::class,
            $repository
        );
    }
}
