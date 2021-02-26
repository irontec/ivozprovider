<?php

namespace Tests\Provider\BillableCallHistoric;

use Ivoz\Provider\Domain\Model\BillableCallHistoric\BillableCallHistoric;
use Ivoz\Provider\Domain\Model\BillableCallHistoric\BillableCallHistoricRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class BillableCallHistoricRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_copies_rows_from_billable_Calls();
        $this->it_finds_max_id();
    }

    private function it_copies_rows_from_billable_Calls()
    {
        /** @var BillableCallHistoricRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCallHistoric::class);

        $affectedRows = $billableCallRepository
            ->copyBillableCallsByIds([
                1,
                2
            ]);

        $this->assertEquals(
            2,
            $affectedRows
        );
    }

    private function it_finds_max_id()
    {
        /** @var BillableCallHistoricRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCallHistoric::class);

        $expectedMaxId = 50;
        $billableCallRepository
            ->copyBillableCallsByIds([
                $expectedMaxId
            ]);

        $maxId = $billableCallRepository->getMaxId();

        $this->assertEquals(
            $expectedMaxId,
            $maxId
        );
    }
}
