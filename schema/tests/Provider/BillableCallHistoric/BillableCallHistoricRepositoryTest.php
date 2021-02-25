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
        $this->it_syncs_tables();
    }

    private function it_syncs_tables()
    {
        /** @var BillableCallHistoricRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCallHistoric::class);

        $affectedRows = $billableCallRepository->sync();

        $this->assertGreaterThan(
            1,
            $affectedRows
        );
    }
}
