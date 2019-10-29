<?php

namespace Tests\Provider\BillableCall;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;

class BillableCallRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_outgoing_call_by_callid();
        $this->it_finds_one_by_trunksCdrId();
        $this->it_checks_retarificable_calls();
        $this->it_finds_unrated_calls_in_group();
        $this->it_finds_rerateable_cgrids_in_group();
        $this->it_transforms_ids_to_trunkCdrId();
        $this->it_counts_untarificatted_calls_in_range();
    }

    public function it_finds_outgoing_call_by_callid()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $billableCalls = $billableCallRepository
            ->findOutboundByCallid(
                '017cc7c8-eb38-4bbd-9318-524a274f7001'
            );

        $this->assertCount(
            1,
            $billableCalls
        );

        $this->assertInstanceOf(
            BillableCall::class,
            $billableCalls[0]
        );
    }

    public function it_finds_one_by_trunksCdrId()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $retarificable = $billableCallRepository
            ->findOneByTrunksCdrId(1);

        $this->assertInstanceOf(
            BillableCall::class,
            $retarificable
        );
    }

    /**
     * @see BillableCallRepository::areRetarificable
     */
    public function it_checks_retarificable_calls()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $retarificable = $billableCallRepository
            ->areRetarificable([1]);

        $this->assertInternalType(
            'boolean',
            $retarificable
        );
    }

    /**
     * @see BillableCallRepository::findUnratedInGroup
     */
    public function it_finds_unrated_calls_in_group()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $cgrids = $billableCallRepository
            ->findUnratedInGroup([]);

        $this->assertInternalType(
            'array',
            $cgrids
        );
    }

    /**
     * @see BillableCallRepository::findRerateableCgridsInGroup
     */
    public function it_finds_rerateable_cgrids_in_group()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $cgrids = $billableCallRepository
            ->findRerateableCgridsInGroup([1]);

        $this->assertInternalType(
            'array',
            $cgrids
        );
    }

    public function it_transforms_ids_to_trunkCdrId()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $cgrids = $billableCallRepository
            ->idsToTrunkCdrId([1]);

        $this->assertInternalType(
            'array',
            $cgrids
        );
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function it_throws_exception_if_trunkCdrIds_are_missing()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $cgrids = $billableCallRepository
            ->idsToTrunkCdrId([99999]);
    }

    /**
     * @test
     */
    public function it_resets_pricing_data()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->resetPricingData([1]);

        $billableCallChanges = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertInternalType(
            'null',
            $response
        );
    }

    /**
     * @test
     */
    public function it_resets_invoice_id()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->resetInvoiceId(1);

        $billableCallChanges = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertInternalType(
            'null',
            $response
        );
    }

    /**
     * @test
     */
    public function it_sets_invoice_id()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->setInvoiceId(
                [
                    ['brand', 'eq', 1]
                ],
                1
            );

        $billableCallChanges = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertInternalType(
            'null',
            $response
        );
    }

    /**
     * @test
     */
    public function it_gets_untarificatted_call_ids_in_range()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->getUntarificattedCallIdsInRange(
                1,
                1,
                '2019-01-01 00:00:01',
                '2019-01-02 00:00:01'
            );

        $this->assertInternalType(
            'array',
            $response
        );
    }

    public function it_counts_untarificatted_calls_in_range()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->countUntarificattedCallsInRange(
                1,
                1,
                '2015-10-10 00:00:01',
                '2025-10-10 00:00:01'
            );

        $this->assertInternalType(
            'int',
            $response
        );
    }
}
