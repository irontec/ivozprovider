<?php

namespace Tests\Provider\CallCsvReport;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;

class CallCsvReportLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return CallCsvReportDto
     */
    protected function createDto()
    {
        $callCsvReportDto = new CallCsvReportDto();
        $callCsvReportDto
            ->setSentTo('mikel+test-orm@irontec.com')
            ->setInDate(
                new \DateTime('2017-12-31 23:00:00')
            )->setOutDate(
                new \DateTime('2018-12-31 22:59:59')
            )->setCompanyId(
                1
            )->setCreatedOn(
                new \DateTime('2018-12-31 23:59:59')
            )
            ->setCallCsvSchedulerId(1);

        return $callCsvReportDto;
    }

    /**
     * @return CallCsvReport
     */
    protected function addCallCsvReport()
    {
        $callCsvReportDto = $this->createDto();

        /** @var CallCsvReport $callCsvReport */
        $callCsvReport = $this->entityTools
            ->persistDto($callCsvReportDto, null, true);

        return $callCsvReport;
    }

    /**
     * @test
     */
    public function it_persists_callCsvReports()
    {
        $callCsvReport = $this->em
            ->getRepository(CallCsvReport::class);
        $fixtureCallCsvReports = $callCsvReport->findAll();

        $this
            ->addCallCsvReport();

        $brands = $callCsvReport->findAll();
        $this->assertCount(count($fixtureCallCsvReports) + 1, $brands);


        $this->added_callCsvReport_has_csv();
    }

    protected function added_callCsvReport_has_csv()
    {
        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            CallCsvReport::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'sentTo' => 'mikel+test-orm@irontec.com',
                'inDate' => '2017-12-31 23:00:00',
                'outDate' => '2018-12-31 22:59:59',
                'createdOn' => '2018-12-31 23:59:59',
                'csvFileSize' => 0,
                'csvMimeType' => 'application/x-empty; charset=binary',
                'csvBaseName' => 'DemoCompany-20180101-20181231.csv',
                'companyId' => 1,
                'callCsvSchedulerId' => 1,
                'id' => 3
            ]
        );
    }
}
