<?php

namespace Tests\Provider\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsage;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageDto;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class ChannelUsageRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_one_by_company_and_timestamp();
        $this->it_returns_null_for_an_unknown_bucket();
        $this->it_finds_a_whole_batch_within_a_timestamp_range();
        $this->it_returns_nothing_without_companies();
        $this->it_purges_rows_older_than_the_cutoff();
        $this->it_never_deletes_more_than_the_batch_limit();
    }

    private function it_finds_one_by_company_and_timestamp()
    {
        $this->addChannelUsage('2026-01-01 00:00:00');

        $channelUsage = $this
            ->getRepository()
            ->findOneByCompanyAndTimestamp(
                1,
                new \DateTime('2026-01-01 00:00:00', new \DateTimeZone('UTC'))
            );

        $this->assertInstanceOf(
            ChannelUsage::class,
            $channelUsage
        );

        $this->assertEquals(
            2,
            $channelUsage->getPeak()
        );
    }

    private function it_returns_null_for_an_unknown_bucket()
    {
        $channelUsage = $this
            ->getRepository()
            ->findOneByCompanyAndTimestamp(
                1,
                new \DateTime('2020-06-06 06:00:00', new \DateTimeZone('UTC'))
            );

        $this->assertNull($channelUsage);
    }

    private function it_finds_a_whole_batch_within_a_timestamp_range()
    {
        $this->addChannelUsage('2026-01-01 00:05:00');
        $this->addChannelUsage('2026-01-01 00:10:00');
        // Outside the window below
        $this->addChannelUsage('2026-01-01 01:00:00');

        $channelUsages = $this
            ->getRepository()
            ->findByCompaniesAndTimestampRange(
                [1],
                new \DateTime('2026-01-01 00:00:00', new \DateTimeZone('UTC')),
                new \DateTime('2026-01-01 00:10:00', new \DateTimeZone('UTC'))
            );

        // 00:00, 00:05 and 00:10, but not 01:00
        $this->assertCount(
            3,
            $channelUsages
        );
    }

    private function it_returns_nothing_without_companies()
    {
        $channelUsages = $this
            ->getRepository()
            ->findByCompaniesAndTimestampRange(
                [],
                new \DateTime('2026-01-01 00:00:00', new \DateTimeZone('UTC')),
                new \DateTime('2026-01-01 01:00:00', new \DateTimeZone('UTC'))
            );

        $this->assertCount(
            0,
            $channelUsages
        );
    }

    private function it_purges_rows_older_than_the_cutoff()
    {
        $this->addChannelUsage('2020-01-01 00:00:00');
        $this->addChannelUsage('2020-01-01 00:05:00');

        $deleted = $this
            ->getRepository()
            ->purgeOlderThan(
                new \DateTime('2021-01-01 00:00:00', new \DateTimeZone('UTC')),
                100
            );

        $this->assertEquals(
            2,
            $deleted
        );

        // The 2026 buckets are untouched
        $this->assertNotNull(
            $this
                ->getRepository()
                ->findOneByCompanyAndTimestamp(
                    1,
                    new \DateTime('2026-01-01 00:00:00', new \DateTimeZone('UTC'))
                )
        );
    }

    private function it_never_deletes_more_than_the_batch_limit()
    {
        $this->addChannelUsage('2019-01-01 00:00:00');
        $this->addChannelUsage('2019-01-01 00:05:00');
        $this->addChannelUsage('2019-01-01 00:10:00');

        $deleted = $this
            ->getRepository()
            ->purgeOlderThan(
                new \DateTime('2020-01-01 00:00:00', new \DateTimeZone('UTC')),
                2
            );

        $this->assertEquals(
            2,
            $deleted
        );

        // The remainder is left for the next batch
        $deleted = $this
            ->getRepository()
            ->purgeOlderThan(
                new \DateTime('2020-01-01 00:00:00', new \DateTimeZone('UTC')),
                2
            );

        $this->assertEquals(
            1,
            $deleted
        );
    }

    private function getRepository(): ChannelUsageRepository
    {
        /** @var ChannelUsageRepository $repository */
        $repository = $this->em->getRepository(ChannelUsage::class);

        return $repository;
    }

    private function addChannelUsage(string $timestamp, int $companyId = 1): void
    {
        $dto = new ChannelUsageDto();
        $dto
            ->setBrandId(1)
            ->setCompanyId($companyId)
            ->setTimestamp(
                new \DateTime($timestamp, new \DateTimeZone('UTC'))
            )
            ->setPeak(2)
            ->setAvgUsage(1.5)
            ->setClosingUsage(1)
            ->setMaxCallsCompany(10)
            ->setMaxCallsBrand(20)
            ->setBlockedByCompanyLimit(0)
            ->setBlockedByBrandLimit(0);

        $this->entityTools->persistDto($dto, null, true);
    }
}
