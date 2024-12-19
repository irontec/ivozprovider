<?php

namespace Tests\Provider\ApplicationServerSet;

use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class ApplicationServerSetLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_cascade_delete_kam_dispatcher()
    {
        $dispatcherRepository = $this
            ->em
            ->getRepository(
                Dispatcher::class
            );

        $applicationServerSetId = 2;
        $dispatcher = $dispatcherRepository->findOneBy([
            'setid' => $applicationServerSetId
        ]);

        $this->assertNotNull($dispatcher);

        $this->removeApplicationServerSet(
            $applicationServerSetId
        );

        $dispatcher = $dispatcherRepository->findOneBy([
            'setid' => $applicationServerSetId
        ]);

        $this->assertNull($dispatcher);
    }

    protected function removeApplicationServerSet(int $id)
    {
        $dispatcherRepository = $this
            ->em
            ->getRepository(
                Dispatcher::class
            );

        $applicationServeSetRepository = $this->em
            ->getRepository(ApplicationServerSet::class);

        $setRelAs = $applicationServeSetRepository->find($id);

        $this->em->remove($setRelAs);
        $this->em->flush(null);
    }
}
