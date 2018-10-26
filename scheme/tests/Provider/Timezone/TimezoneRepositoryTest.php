<?php

namespace Tests\Provider\Timezone;

use Ivoz\Provider\Domain\Model\Timezone\TimezoneRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;

class TimezoneRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var TimezoneRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Timezone::class);

        $this->assertInstanceOf(
            TimezoneRepository::class,
            $repository
        );
    }
}