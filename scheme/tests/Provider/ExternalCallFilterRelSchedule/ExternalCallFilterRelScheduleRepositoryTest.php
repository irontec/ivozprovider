<?php

namespace Tests\Provider\ExternalCallFilterRelSchedule;

use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;

class ExternalCallFilterRelScheduleRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ExternalCallFilterRelScheduleRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ExternalCallFilterRelSchedule::class);

        $this->assertInstanceOf(
            ExternalCallFilterRelScheduleRepository::class,
            $repository
        );
    }
}
