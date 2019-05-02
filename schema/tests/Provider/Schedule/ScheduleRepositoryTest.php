<?php

namespace Tests\Provider\Schedule;

use Ivoz\Provider\Domain\Model\Schedule\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Schedule\Schedule;

class ScheduleRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ScheduleRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Schedule::class);

        $this->assertInstanceOf(
            ScheduleRepository::class,
            $repository
        );
    }
}
