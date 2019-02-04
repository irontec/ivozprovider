<?php

namespace Tests\Provider\HolidayDate;

use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate;

class HolidayDateRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var HolidayDateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(HolidayDate::class);

        $this->assertInstanceOf(
            HolidayDateRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_events_matching_date_by_holidayDate()
    {
        /** @var HolidayDateRepository $holidayDateRepository */
        $holidayDateRepository = $this
            ->em
            ->getRepository(HolidayDate::class);

        $holidayDate2 = $holidayDateRepository->find(2);
        $holidayDates = $holidayDateRepository->findMatchingDateSiblings($holidayDate2);

        $this->assertInternalType('array', $holidayDates);
        $this->assertCount(1, $holidayDates);
    }
}
