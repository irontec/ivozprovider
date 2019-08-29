<?php

namespace Tests\Provider\Trusted;

use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\Trusted\Trusted;
use Ivoz\Kam\Domain\Model\Trusted\TrustedRepository;

class TrustedRepositoryTest extends KernelTestCase
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
        /** @var TrustedRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Trusted::class);

        $this->assertInstanceOf(
            TrustedRepository::class,
            $repository
        );
    }
}
