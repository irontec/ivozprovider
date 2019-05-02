<?php

namespace Tests\Provider\ConferenceRoom;

use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;

class ConferenceRoomRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ConferenceRoomRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConferenceRoom::class);

        $this->assertInstanceOf(
            ConferenceRoomRepository::class,
            $repository
        );
    }
}
