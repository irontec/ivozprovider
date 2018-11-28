<?php

namespace Tests\Provider\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelSchedule;

class ConditionalRoutesConditionsRelScheduleRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ConditionalRoutesConditionsRelScheduleRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConditionalRoutesConditionsRelSchedule::class);

        $this->assertInstanceOf(
            ConditionalRoutesConditionsRelScheduleRepository::class,
            $repository
        );
    }
}