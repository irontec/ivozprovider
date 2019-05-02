<?php

namespace Tests\Provider\Administrator;

use Ivoz\Provider\Infrastructure\Persistence\Doctrine\AdministratorDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;

class AdministratorRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_gets_inner_global_admin()
    {
        /** @var AdministratorDoctrineRepository $repository */
        $repository = $this->em
            ->getRepository(Administrator::class);

        $innerAdmin = $repository->getInnerGlobalAdmin();

        $this->assertInstanceOf(
            Administrator::class,
            $innerAdmin
        );

        $this->assertEquals(
            $innerAdmin->getId(),
            0
        );
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function it_throws_exception_if_inner_global_admin_is_not_found()
    {
        /** @var AdministratorDoctrineRepository $repository */
        $repository = $this->em
            ->getRepository(Administrator::class);

        $innerAdmin = $repository->find(0);
        $this->em->remove($innerAdmin);
        $this->em->flush();

        $innerAdmin = $repository->getInnerGlobalAdmin();

        $this->assertInstanceOf(
            Administrator::class,
            $innerAdmin
        );

        $this->assertEquals(
            $innerAdmin->getId(),
            0
        );
    }

    public function it_gets_platform_admin_by_username()
    {
        /** @var AdministratorDoctrineRepository $repository */
        $repository = $this->em
            ->getRepository(Administrator::class);

        $platformAdmin = $repository->findPlatformAdminByUsername('admin');

        $this->assertInstanceOf(
            Administrator::class,
            $platformAdmin
        );
    }

    public function it_returns_null_if_platform_admin_is_not_found()
    {
        /** @var AdministratorDoctrineRepository $repository */
        $repository = $this->em
            ->getRepository(Administrator::class);

        $platformAdmin = $repository->findPlatformAdminByUsername('unexisting_admin');

        $this->assertNull(
            $platformAdmin
        );
    }
}
