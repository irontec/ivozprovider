<?php

namespace Tests\Provider\HolidayDate;

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
}