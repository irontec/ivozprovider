<?php

namespace Tests\Provider\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;

class TpDestinationRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_by_tag();
    }

    public function its_instantiable()
    {
        /** @var TpDestinationRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpDestination::class);

        $this->assertInstanceOf(
            TpDestinationRepository::class,
            $repository
        );
    }

    public function it_finds_by_tag()
    {
        /** @var TpDestinationRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpDestination::class);

        $result = $repository
            ->findOneByTag('tag');

        $this->assertNull(
            $result
        );
    }
}
