<?php

namespace Tests\Cgr\TpCdr;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdr;
use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;

class TpCdrRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var TpCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpCdr::class);

        $this->assertInstanceOf(
            TpCdrRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_by_origin_id()
    {
        /** @var TpCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpCdr::class);

        $result = $repository->getByOriginId('1');

        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function it_finds_default_run_by_cgr_id()
    {
        /** @var TpCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpCdr::class);

        $result = $repository->getDefaultRunByCgrid('1');

        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function it_finds_carrier_run_by_cgr_id()
    {
        /** @var TpCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpCdr::class);

        $result = $repository->getCarrierRunByCgrid('1');

        $this->assertNull($result);
    }
}
