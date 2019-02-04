<?php

namespace Tests\Provider\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendar;

class ConditionalRoutesConditionsRelCalendarRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ConditionalRoutesConditionsRelCalendarRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConditionalRoutesConditionsRelCalendar::class);

        $this->assertInstanceOf(
            ConditionalRoutesConditionsRelCalendarRepository::class,
            $repository
        );
    }
}
