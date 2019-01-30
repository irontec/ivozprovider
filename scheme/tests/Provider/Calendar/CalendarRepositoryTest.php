<?php

namespace Tests\Provider\Calendar;

use Ivoz\Provider\Domain\Model\Calendar\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;

class CalendarRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CalendarRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Calendar::class);

        $this->assertInstanceOf(
            CalendarRepository::class,
            $repository
        );
    }
}
