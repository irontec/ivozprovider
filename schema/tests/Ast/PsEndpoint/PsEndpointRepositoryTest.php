<?php

namespace Tests\Provider\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
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
    public function it_finds_one_by_residentialDeviceId()
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

    /**
     * @test
     */
    public function it_finds_one_by_retail_account_Id()
    {
        /** @var PsEndpointRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PsEndpoint::class);

        $result = $repository->findOneByRetailAccountId(1);

        $this->assertNull(
            $result
        );
    }

    /**
     * @test
     */
    public function it_finds_one_by_terminal_Id()
    {
        /** @var PsEndpointRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PsEndpoint::class);

        $result = $repository->findOneByTerminalId(1);

        $this->assertInstanceOf(
            PsEndpointInterface::class,
            $result
        );
    }

    /**
     * @test
     */
    public function it_finds_one_by_sorcery_Id()
    {
        /** @var PsEndpointRepository $repository */
        $repository = $this
            ->em
            ->getRepository(PsEndpoint::class);

        $result = $repository->findOneBySorceryId('b1c1t2_bob');

        $this->assertInstanceOf(
            PsEndpointInterface::class,
            $result
        );
    }
}
