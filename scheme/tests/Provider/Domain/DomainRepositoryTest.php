<?php

namespace Tests\Provider\Domain;

use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Domain\Domain;

class DomainRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $this->assertInstanceOf(
            DomainRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_one_by_domain()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $Domain = $repository->findOneByDomain('users.ivozprovider.local');

        $this->assertInstanceOf(
            Domain::class,
            $Domain
        );
    }
}
