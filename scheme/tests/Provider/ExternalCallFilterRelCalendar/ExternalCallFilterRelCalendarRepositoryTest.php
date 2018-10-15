<?php

namespace Tests\Provider\ExternalCallFilterRelCalendar;

use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar;

class ExternalCallFilterRelCalendarRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ExternalCallFilterRelCalendarRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ExternalCallFilterRelCalendar::class);

        $this->assertInstanceOf(
            ExternalCallFilterRelCalendarRepository::class,
            $repository
        );
    }
}