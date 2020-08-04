<?php

namespace Tests\Provider\CallCsvScheduler;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;

class CallCsvSchedulerRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_gets_company_ids_in_use();
        $this->it_gets_pending_schedulers();
        $this->it_tells_name_uniqueness();
    }

    public function it_gets_company_ids_in_use()
    {
        /** @var CallCsvSchedulerRepository $callCsvSchedulerRepository */
        $callCsvSchedulerRepository = $this->em
            ->getRepository(CallCsvScheduler::class);

        /** @var array $ids */
        $ids = $callCsvSchedulerRepository
            ->getCompanyIdsInUse(1);

        $this->assertIsArray(
            $ids
        );
    }

    public function it_gets_pending_schedulers()
    {
        /** @var CallCsvSchedulerRepository $callCsvSchedulerRepository */
        $callCsvSchedulerRepository = $this->em
            ->getRepository(CallCsvScheduler::class);

        /** @var CallCsvSchedulerInterface[] $callCsvSchedulers */
        $callCsvSchedulers = $callCsvSchedulerRepository
            ->getPendingSchedulers();

        $this->assertIsArray(
            $callCsvSchedulers
        );
    }

    public function it_tells_name_uniqueness()
    {
        /** @var CallCsvSchedulerRepository $callCsvSchedulerRepository */
        $callCsvSchedulerRepository = $this->em
            ->getRepository(CallCsvScheduler::class);

        $callCsvSchedulerMock = $this
            ->getMockBuilder(CallCsvScheduler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $companyMock = $this
            ->getMockBuilder(Company::class)
            ->disableOriginalConstructor()
            ->getMock();

        $callCsvSchedulerMock
            ->method('getCompany')
            ->willReturn($companyMock);

        /** @var CallCsvSchedulerInterface[] $isUnique */
        $isUnique = $callCsvSchedulerRepository
            ->hasUniqueName($callCsvSchedulerMock);

        $this->assertIsBool(
            $isUnique
        );
    }
}
