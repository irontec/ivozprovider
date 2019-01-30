<?php

namespace Tests\Provider\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\PsEndpointDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;

class PsEndpointRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var PsEndpointRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PsEndpoint::class);

        $this->assertInstanceOf(
            PsEndpointRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_by_friendId()
    {
        /** @var PsEndpointRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PsEndpoint::class);

        $result = $repository->findOneByFriendId(1);

        $this->assertInstanceOf(
            PsEndpointInterface::class,
            $result
        );
    }


    /**
     * @test
     */
    public function it_finds_by_residentialDeviceId()
    {
        /** @var PsEndpointRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PsEndpoint::class);

        $result = $repository->findOneByResidentialDeviceId(1);

        $this->assertInstanceOf(
            PsEndpointInterface::class,
            $result
        );
    }
}
