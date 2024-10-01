<?php

namespace Tests\Provider\ApplicationServerSet;

use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetRepository;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\ApplicationServerSetDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;

class ApplicationServerSetRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_gets_default_application_server_set();
        $this->it_throws_exception_if_default_application_server_set_is_removed();
    }

    public function its_instantiable()
    {
        /** @var ApplicationServerSetRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ApplicationServerSet::class);

        $this->assertInstanceOf(
            ApplicationServerSetRepository::class,
            $repository
        );
    }

    public function it_gets_default_application_server_set()
    {
        /** @var ApplicationServerSetDoctrineRepository $repository */
        $repository = $this->em
            ->getRepository(ApplicationServerSet::class);

        $defaultSet = $repository->find(0);

        $this->assertInstanceOf(
            ApplicationServerSet::class,
            $defaultSet
        );

        $this->assertEquals(
            $defaultSet->getId(),
            0
        );
    }

    /**
     * @test
     */
    public function it_throws_exception_if_default_application_server_set_is_removed()
    {
        $this->expectException(
            \DomainException::class
        );

        /** @var ApplicationServerSetDoctrineRepository $repository */
        $repository = $this->em
            ->getRepository(ApplicationServerSet::class);

        $defaultSet = $repository->find(0);
        $this->em->remove($defaultSet);
        $this->em->flush();
    }
}
