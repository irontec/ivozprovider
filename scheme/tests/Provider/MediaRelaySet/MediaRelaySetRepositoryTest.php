<?php

namespace Tests\Provider\MediaRelaySet;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;

class MediaRelaySetRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var MediaRelaySetRepository $repository */
        $repository = $this
            ->em
            ->getRepository(MediaRelaySet::class);

        $this->assertInstanceOf(
            MediaRelaySetRepository::class,
            $repository
        );
    }
}
