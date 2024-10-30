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
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_cannot_remove_default_set();
    }

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

    public function it_cannot_remove_default_set()
    {
        /** @var MediaRelaySetRepository $repository */
        $repository = $this
            ->em
            ->getRepository(MediaRelaySet::class);;

        $mediaRelaySet = $repository->find(0);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage(
            'Default media relay set cannot be deleted'
        );

        $this
            ->entityTools
            ->remove($mediaRelaySet);
    }
}
