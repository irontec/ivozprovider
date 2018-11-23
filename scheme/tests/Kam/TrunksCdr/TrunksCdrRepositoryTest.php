<?php

namespace Tests\Provider\TrunksCdr;

use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;

class TrunksCdrRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $this->assertInstanceOf(
            TrunksCdrRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_by_callid()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $result = $repository
            ->findByCallid('1262640e-18d5-4641-880d-e4f411786711');

        $this->assertCount(
            1,
            $result
        );

        $this->assertInstanceOf(
            TrunksCdrInterface::class,
            $result[0]
        );
    }

    /**
     * @test
     */
    public function it_finds_one_by_callid()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $result = $repository
            ->findOneByCallid('1262640e-18d5-4641-880d-e4f411786711');

        $this->assertInstanceOf(
            TrunksCdrInterface::class,
            $result
        );
    }

    /**
     * @test
     */
    public function it_finds_unmeteredCalls()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $result = $repository
            ->getUnmeteredCallsGeneratorWithoutOffset(1000);

        $this->assertInstanceOf(
            \Generator::class,
            $result
        );

        foreach ($result as $item) {
            $this->assertInstanceOf(
                TrunksCdrInterface::class,
                $item[0]
            );
        }
    }

    /**
     * @test
     */
    public function it_resets_metered_calls()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $result = $repository
            ->resetMetered([1,2,3]);

        $this->assertNotEmpty($result);
    }


}