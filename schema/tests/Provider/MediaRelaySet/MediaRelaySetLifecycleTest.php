<?php

namespace Tests\Provider\MediaRelaySet;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;
use Ivoz\Provider\Domain\Service\MediaRelaySet\SendUsersRtpengineReloadRequest;
use Ivoz\Provider\Domain\Service\MediaRelaySet\SendTrunksRtpengineReloadRequest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class MediaRelaySetLifecycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_fires_lifeCycle_on_remove()
    {
        $this->mockInfraestructureServices(
            'provider.lifecycle.media_relay_set.service_collection',
            ['on_commit' => [
                SendUsersRtpengineReloadRequest::class,
                SendTrunksRtpengineReloadRequest::class
            ]],
            1
        );

        $this->removeMediaRelaySet();
    }

    protected function removeMediaRelaySet()
    {
        $mediaRelaySetRepository = $this->em
            ->getRepository(MediaRelaySet::class);

        $mediaRelaySet = $mediaRelaySetRepository->find(2);
        $this->entityTools->remove($mediaRelaySet);
    }
}
