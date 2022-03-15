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
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_by_callid();
        $this->it_finds_one_by_callid();
        $this->it_finds_unparsedCalls();
        $this->it_resets_parsed_calls();
        $this->it_get_cgrids_by_billableCalls();
        $this->it_resets_orphan_cgrids();
    }

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

    public function it_finds_unparsedCalls()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $result = $repository
            ->getUnparsedCallsGeneratorWithoutOffset(1000);

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

    public function it_resets_parsed_calls()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $result = $repository
            ->resetParsed([1,2,3]);

        $billableCallChanges = $this->getChangelogByClass(
            TrunksCdr::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertNotEmpty($result);
    }

    public function it_get_cgrids_by_billableCalls()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $cgrids = $repository
            ->getCgridsByBillableCallIds([
                1
            ]);

        $this->assertInternalType(
            'array',
            $cgrids
        );

        $this->assertEquals(
            '5a364b1fe35e00fb2ac1923b43f84eeb78400e01',
            $cgrids[0]
        );
    }

    public function it_resets_orphan_cgrids()
    {
        /** @var TrunksCdrRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksCdr::class);

        $affectedRows = $repository
            ->resetOrphanCgrids([
                '5a364b1fe35e00fb2ac1923b43f84eeb78400e01',
                '5a364b1fe35e00fb2ac1923b43f84eeb78400e02',
                '5a364b1fe35e00fb2ac1923b43f84eeb78400e03',
            ]);

        $this->assertEquals(
            1,
            $affectedRows
        );
    }
}
