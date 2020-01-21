<?php

namespace Tests\Provider\BillableCall;

use Ivoz\Core\Infrastructure\Application\DoctrineForeignKeyTransformer;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
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
        $this->it_counts_unrated_calls_in_range();
    }

    private function it_finds_outgoing_call_by_callid()
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

    private function it_finds_one_by_trunksCdrId()
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
    private function it_checks_retarificable_calls()
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
    private function it_finds_unrated_calls_in_group()
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
    private function it_finds_rerateable_cgrids_in_group()
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

    private function it_transforms_ids_to_trunkCdrId()
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
        $affectedRows = $billableCallRepository
            ->resetPricingData([1]);

        $billableCallChanges = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertEquals(
            1,
            $affectedRows
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
        $affectedRows = $billableCallRepository
            ->resetInvoiceId(1);

        $billableCallChanges = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertEquals(
            1,
            $affectedRows
        );
    }

    private function _getInvoiceStub(
        string $inDate = '2020-01-01 12:00:00',
        string $outDate = '2020-01-07 12:00:00'
    ): InvoiceInterface {
        $invoiceDto = new InvoiceDto();

        $invoiceDto
            ->setBrandId(1)
            ->setCompanyId(1)
            ->setInDate(
                new \DateTime($inDate)
            )
            ->setOutDate(
                new \DateTime($outDate)
            );

        $fkTransforer = new DoctrineForeignKeyTransformer($this->em);

        return Invoice::fromDto(
            $invoiceDto,
            $fkTransforer
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
        $affectedRows = $billableCallRepository
            ->setInvoiceId(
                $this->_getInvoiceStub(
                    '2019-01-01 00:00:00',
                    '2019-01-01 23:59:59'
                )
            );

        $billableCallChanges = $this->getChangelogByClass(
            BillableCall::class
        );

        $this->assertCount(
            1,
            $billableCallChanges
        );

        $this->assertEquals(
            100,
            $affectedRows
        );
    }

    /**
     * @test
     */
    public function it_gets_unrated_call_ids_in_range()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->getUnratedCallIdsByInvoice(
                $this->_getInvoiceStub(
                    '2019-01-01 00:00:01',
                    '2019-01-02 00:00:01'
                )
            );

        $this->assertInternalType(
            'array',
            $response
        );
    }

    private function it_counts_unrated_calls_in_range()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCalls */
        $response = $billableCallRepository
            ->countUnratedCallsByInvoice(
                $this->_getInvoiceStub(
                    '2015-10-10 00:00:01',
                    '2025-10-10 00:00:01'
                )
            );

        $this->assertInternalType(
            'int',
            $response
        );
    }
}
