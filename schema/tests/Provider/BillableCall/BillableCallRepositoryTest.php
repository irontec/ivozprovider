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
        $this->it_finds_min_start_time();
        $this->it_finds_ids_in_range();
        $this->it_finds_max_id_until_date();
        $this->it_finds_initial_four_by_company_id();
        $this->it_finds_last_by_callid_and_direction();
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

        $this->assertIsBool(
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

        $this->assertIsArray(
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

        $this->assertIsArray(
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

        $this->assertIsArray(
            $cgrids
        );
    }

    /**
     * @test
     */
    public function it_throws_exception_if_trunkCdrIds_are_missing()
    {
        $this->expectException(
            \RuntimeException::class
        );

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
            ->setNumber('+34234123')
            ->setBrandId(1)
            ->setCompanyId(1)
            ->setTotal(23.5)
            ->setTaxRate(0.1)
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

        $this->assertIsArray(
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

        $this->assertIsInt(
            $response
        );
    }

    private function it_finds_min_start_time()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCall */
        $billableCall = $billableCallRepository->find(1);

        $response = $billableCallRepository
            ->getMinStartTime(0);

        $this->assertEquals(
            $response,
            $billableCall->getStartTime()
        );
    }

    private function it_finds_max_id_until_date()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCall2 */
        $billableCall2 = $billableCallRepository->find(2);

        $maxId = $billableCallRepository
            ->getMaxIdUntilDate(
                0,
                $billableCall2->getStartTime()
            );

        $this->assertEquals(
            2,
            $maxId
        );
    }

    private function it_finds_ids_in_range()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface $billableCall3 */
        $billableCall3 = $billableCallRepository->find(3);

        $ids = $billableCallRepository
            ->getIdsInRange(
                0,
                $billableCall3->getId(),
                1000
            );

        $this->assertIsArray(
            $ids
        );

        $this->assertCount(
            3,
            $ids
        );
    }

    private function it_finds_initial_four_by_company_id()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface[] $billableCall1 */
        $billableCalls = $billableCallRepository->findInitialFourByCompanyId(1);

        $this->assertIsArray(
            $billableCalls
        );

        $this->assertCount(
            4,
            $billableCalls
        );
    }

    private function it_finds_last_by_callid_and_direction()
    {
        /** @var BillableCallRepository $billableCallRepository */
        $billableCallRepository = $this->em
            ->getRepository(BillableCall::class);

        /** @var BillableCallInterface[] $billableCall1 */
        $billableCall = $billableCallRepository->findLastByCallidAndDirection(
            '017cc7c8-eb38-4bbd-9318-524a274f7099',
            BillableCallInterface::DIRECTION_OUTBOUND,
        );

        $this->assertInstanceOf(
            BillableCall::class,
            $billableCall
        );

        $this->assertEquals(
            100,
            $billableCall->getId(),
        );
    }
}
