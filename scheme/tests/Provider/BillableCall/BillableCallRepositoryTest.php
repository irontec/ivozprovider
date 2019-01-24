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
     * @test
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
     * @test
     * @see BillableCallRepository::findRerateableCgridsInGroup
     */
    public function it_finds_rerateable_cgrids_in_group()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $cgrids = $billableCallRepository
            ->findRerateableCgridsInGroup([]);

        $this->assertInternalType(
            'array',
            $cgrids
        );
    }

    /**
     * @test
     */
    public function it_transforms_ids_to_trunkCdrId()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $cgrids = $billableCallRepository
            ->idsToTrunkCdrId([]);

        $this->assertInternalType(
            'array',
            $cgrids
        );
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

        $this->assertInternalType(
            'null',
            $response
        );
    }

    /**
     * @test
     */
    public function it_counts_untarificatted_calls_before_date()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->countUntarificattedCallsBeforeDate(
                1,
                1,
                '2025-10-10 00:00:01'
            );

        $this->assertInternalType(
            'int',
            $response
        );
    }

    /**
     * @test
     */
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
